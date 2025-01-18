<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attachment;
class DownloadController extends Controller
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
}
