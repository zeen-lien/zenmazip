<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KompresiController extends Controller
{
    public function index()
    {
        return view('kompresi-file');
    }

    public function kompresiZip(Request $request)
    {
        $request->validate([
            'files' => 'required',
            'files.*' => 'file',
        ]);

        $zipFileName = 'kompresi_' . time() . '.zip';
        $zipFilePath = storage_path('app/public/' . $zipFileName);

        $zip = new \ZipArchive();
        if ($zip->open($zipFilePath, \ZipArchive::CREATE) !== true) {
            return response()->json(['error' => 'Gagal membuat file ZIP'], 500);
        }

        \Log::info('DEBUG KOMRESI FILES', [
            'files' => $request->file('files'),
            'files_count' => is_array($request->file('files')) ? count($request->file('files')) : 0,
        ]);
        $adaFileValid = false;
        foreach ($request->file('files') as $file) {
            $realPath = $file->getPathname();
            \Log::info('DEBUG FILE ITEM', [
                'original_name' => $file->getClientOriginalName(),
                'real_path' => $realPath,
                'size' => $file->getSize(),
                'is_valid' => $file->isValid(),
            ]);
            if ($realPath && file_exists($realPath)) {
                $zip->addFile($realPath, $file->getClientOriginalName());
                $adaFileValid = true;
            }
        }
        $zip->close();

        if (!$adaFileValid) {
            // Hapus file zip kosong jika tidak ada file valid
            if (file_exists($zipFilePath)) {
                unlink($zipFilePath);
            }
            return back()->with('error', 'Tidak ada file valid yang bisa dikompresi.');
        }

        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }
}
