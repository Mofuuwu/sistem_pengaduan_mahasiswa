<?php
namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Complaint;
use App\Models\Logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;  // Pastikan Str digunakan untuk generate nama unik

class ComplaintController extends Controller
{
    public function search_complaint() {
        $complaints = Complaint::all();
        return view('home.search-complaint', ['complaints' => $complaints]);
    }

    public function detail($id) {
        $complaint = Complaint::findOrFail($id);
        return view('home.complaint-detail', ['complaint' => $complaint]);
    }

    public function handle_complaint(Request $request)
    {
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
        return response()->json([
            'message' => 'Pengaduan berhasil disubmit!',
            'complaint' => $complaint,
        ]);
    }
}
