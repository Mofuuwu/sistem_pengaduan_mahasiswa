<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attachment;
use App\Models\Complaint;

class HelperController extends Controller
{
    public function downloadAttachment($id)
    {
        $attachment = Attachment::findOrFail($id);
        if ($attachment->file_type != 'pdf') {
            return redirect()->route('home')->with('error', 'File tidak valid untuk diunduh.');
        }
    
        $filePath = public_path($attachment->path_file);
    
        // Pastikan file ada sebelum unduh
        if (!file_exists($filePath)) {
            return redirect()->route('home')->with('error', 'File tidak ditemukan.');
        }
    
        // Unduh file
        return response()->download($filePath)->deleteFileAfterSend(false);
    }
    public function search_complaint_by_id(Request $request)
    {
        $keyword = $request['keyword'];
        $complaint = Complaint::find($keyword);
    
        if ($complaint) {
            return redirect()->route('complaint_detail', $complaint->id);
        } else {
            return redirect()->back()->with('error_search', 'Aduan yang anda cari tidak ditemukan');
        }
    }
}
