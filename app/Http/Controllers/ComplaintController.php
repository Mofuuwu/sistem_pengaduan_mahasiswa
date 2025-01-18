<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Complaint;
use App\Models\Logs;
use App\Models\Rules;
use App\Models\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;  // Pastikan Str digunakan untuk generate nama unik

class ComplaintController extends Controller
{
    public function search_complaint()
    {
        $complaints = Complaint::orderBy('created_at', 'desc')->paginate(2);
        return view('home.search-complaint', ['complaints' => $complaints]);
    }

    public function detail($id)
    {
        $complaint = Complaint::findOrFail($id);
        if(Auth::check()) {
            $supported = $complaint->supports->contains('user_id', Auth::user()->id);
        } else {
            $supported = null;
        }
        return view('home.complaint-detail', ['complaint' => $complaint, 'supported' => $supported]);
    }
    public function del_support($id) {
        $support = Support::where('complaint_id', $id)->where('user_id', Auth::user()->id);
        $support->delete();
        return back()->with('success', 'Berhasil Membatalkan Dukungan Untuk Aduan Ini');
    }
    public function add_support($id)
    {
        // Cek apakah pengguna sudah memberikan dukungan untuk aduan ini
        $existingSupport = Support::where('user_id', Auth::user()->id)
            ->where('complaint_id', $id)
            ->first();

        if ($existingSupport) {
            // Jika sudah memberikan dukungan, kirimkan notifikasi bahwa mereka sudah mendukung
            // return back()->with('error', 'Anda sudah memberikan dukungan untuk aduan ini.');
            return back();
        }

        // Jika belum ada dukungan, maka tambahkan dukungan baru
        Support::create([
            'user_id' => Auth::user()->id,
            'complaint_id' => $id
        ]);

        // Kirimkan notifikasi sukses
        return back()->with('success', 'Berhasil Mendukung Aduan Ini');
    }
    public function my_complaint()
    {
        if (Auth::check()) {
            $complaints = Complaint::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(2);
        } else {
            $complaints = null;
        }
        return view('home.my-complaint', ['complaints' => $complaints]);
    }
    public function supported_complaint()
    {
        if (Auth::check()) {
            $supported_complaints = Complaint::whereHas('supports', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })->paginate(2);
        } else {
            $supported_complaints = null;
        }
        return view('home.supported-complaint', ['supported_complaints' => $supported_complaints]);
    }

    public function make_complaint() {
        $rules = Rules::all();
        return view('home.make-complaint', ['rules' => $rules]);
    }
    public function handle_complaint(Request $request)
    {
        $request->validate([
            'description' => 'required|string',  
            'location_id' => 'required',  
            'category_id' => 'required',  
            'attachments' => 'required', 
        ], [
            'description.required' => 'Deskripsi aduan harus diisi.',
            'attachments.required' => 'Sertakan minimal 1 bukti foto atau menggunakan pdf', 
            'location_id.required' => 'Lokasi aduan harus dipilih.',
            'category_id.required' => 'Kategori aduan harus dipilih.',
        ]);
    
        $currentDate = now()->format('YmdHis'); // Format: YYYYMMDDHHMMSS

        // Mencari ID yang terakhir pada hari yang sama berdasarkan prefix (timestamp) yang sudah ada
        $lastComplaint = Complaint::where('id', 'like', $currentDate . '%')->orderBy('id', 'desc')->first();

        // Cek urutan ID pada hari yang sama, jika tidak ada maka mulai dari 1
        $lastIdNumber = $lastComplaint ? (int)substr($lastComplaint->id, 14) : 0;
        $newComplaintId = $currentDate . str_pad($lastIdNumber + 1, 3, '0', STR_PAD_LEFT); // Format: YYYYMMDDHHMMSS00001


        // Menyimpan data pengaduan ke database
        $complaint = Complaint::create([
            'id' => (int) $newComplaintId,
            'user_id' => Auth::user()->id,
            'description' => $request['description'],
            'location_id' => $request['location_id'],
            'category_id' => $request['category_id'],
        ]);
        $logs = Logs::create([
            'name' => 'dikirim',
            'description' => '',
            'complaint_id' => $complaint->id,
            'path_file' => '',
            'file_type' => '',
        ]);

        // Jika ada file yang diupload
        if ($request->hasFile('attachments')) {
            $files = $request->file('attachments');

            foreach ($files as $file) {
                // Tentukan nama file unik
                $fileName = Str::random(40) . '.' . $file->getClientOriginalExtension();

                // Cek tipe file
                if ($file->getClientOriginalExtension() == 'pdf') {
                    // Simpan file PDF dengan nama unik
                    $filePath = $file->storeAs('attachments/pdf', $fileName);
                    Attachment::create([
                        'complaint_id' => $complaint->id,
                        'path_file' => Storage::url($filePath),
                        'file_type' => 'pdf',
                    ]);
                } else {
                    // Simpan file gambar (JPEG, PNG, JPG) dengan nama unik
                    $filePath = $file->storeAs('attachments/images', $fileName);
                    Attachment::create([
                        'complaint_id' => $complaint->id,
                        'path_file' => Storage::url($filePath),
                        'file_type' => $file->getClientOriginalExtension(),
                    ]);
                }
            }
        }

        // Mengembalikan response sukses
        return redirect('/aduanku' . '/' . $complaint->id)->with('success', 'Aduan Telah Berhasil Dibuat');
    }
}
