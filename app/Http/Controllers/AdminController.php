<?php
namespace App\Http\Controllers;

use App\Models\Logs;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function add_logs(Request $request)
    {
        $filePath = null;
        $fileType = null;

        if ($request->hasFile('attachment')) {
            if (!Storage::exists('logs')) {
                Storage::makeDirectory('logs');
            }
        
            $file = $request->file('attachment');
            $fileExtension = $file->getClientOriginalExtension();
            $fileName = Str::random(40) . '.' . $fileExtension;
            $filePath = $file->storeAs('logs', $fileName);
            $fileType = $file->getClientMimeType();
        }
        
        $description = $request->input('description', null);

        $data = [
            'name' => $request['name'],
            'description' => $description,
            'complaint_id' => $request['complaint_id'],
            'path_file' => $filePath, 
            'file_type' => $fileType, 
            'employee_id' => $request['employee_id'],
        ];

        Logs::create($data);
        return redirect()->back()->with('success', 'logs berhasil ditambahkan');
    }
    public function del_logs($id) {
        $log = Logs::find($id);

        if ($log) {
            if ($log->path_file && Storage::exists($log->path_file)) {
                Storage::delete($log->path_file);
            }
            $log->delete();
            return redirect()->back()->with('success', 'Log berhasil dihapus.');
        }
        return redirect()->back()->with('success', 'Log tidak ditemukan.');
    }
}
