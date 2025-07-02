<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompressController extends Controller
{
    //
}
use Illuminate\Support\Facades\Storage;
use ZipArchive;

public function compressToZip(Request $request)
{
    $request->validate([
        'files.*' => 'required|file',
    ]);

    $zipFileName = 'compressed_' . time() . '.zip';
    $zipPath = storage_path('app/public/' . $zipFileName);

    $zip = new ZipArchive;
    if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {
        foreach ($request->file('files') as $file) {
            $zip->addFile($file->getRealPath(), $file->getClientOriginalName());
        }
        $zip->close();
    }

    return response()->download($zipPath)->deleteFileAfterSend(true);
}
