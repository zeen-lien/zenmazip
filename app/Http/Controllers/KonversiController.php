<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\TimeCode;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use Dompdf\Dompdf;
use Spatie\PdfToImage\Pdf;
use Smalot\PdfParser\Parser;
use Illuminate\Http\UploadedFile;

class KonversiController extends Controller
{
    public function index()
    {
        return view('konversi-file');
    }

    public function convertImages(Request $request)
    {
        try {
            // Validasi request
            $request->validate([
                'file' => 'required|array',
                'file.*' => 'required|file|mimes:jpg,jpeg,png,gif,bmp,webp,tiff,ico,svg,heic|max:10240', // Max 10MB per file
                'output_format' => 'required|string|in:jpg,jpeg,png,webp,gif',
                'quality' => 'nullable|integer|min:1|max:100',
                'resize_width' => 'nullable|integer|min:1|max:10000',
                'resize_height' => 'nullable|integer|min:1|max:10000',
            ]);

            $files = $request->file('file');
            if (!is_array($files)) {
                $files = [$files];
            }
            $outputFormat = $request->output_format;
            $quality = $request->input('quality', 80);
            $resizeWidth = $request->input('resize_width');
            $resizeHeight = $request->input('resize_height');

            $downloadLinks = [];
            $downloadPaths = [];
            foreach ($files as $file) {
                if (!$file || !$file->isValid()) {
                    continue; // skip file kosong/tidak valid
                }
            $originalExtension = $file->getClientOriginalExtension();
            $fileName = Str::random(40);
            $originalPath = $file->storeAs('temp', $fileName . '.' . $originalExtension);
            $outputPath = 'temp/' . $fileName . '.' . $outputFormat;

                $this->convertImageBatch($originalPath, $outputPath, $outputFormat, $quality, $resizeWidth, $resizeHeight);
                Storage::delete($originalPath);
                $downloadLinks[] = Storage::url($outputPath); // untuk batch (link)
                $downloadPaths[] = $outputPath; // untuk download satu file (path lokal)
            }

            // Jika hanya satu file, langsung download. Jika banyak, tampilkan link download.
            if (count($downloadPaths) === 1) {
                $outputFilePath = storage_path('app/' . $downloadPaths[0]);
                $downloadName = 'converted_file.' . $outputFormat;
                $fileExists = file_exists($outputFilePath);
                \Log::info('Akan download file:', ['path' => $outputFilePath, 'exists' => $fileExists]);
                if ($fileExists) {
                    return response()->download($outputFilePath, $downloadName);
                }
                // Coba cek di public/temp (jika file disimpan di public)
                $publicPath = str_replace('temp/', 'public/temp/', $downloadPaths[0]);
                $publicFilePath = storage_path('app/' . $publicPath);
                $fileExistsPublic = file_exists($publicFilePath);
                \Log::info('Cek file di public/temp:', ['path' => $publicFilePath, 'exists' => $fileExistsPublic]);
                if ($fileExistsPublic) {
                    return response()->download($publicFilePath, $downloadName);
                }
                return back()->with('error', 'File hasil konversi tidak ditemukan: ' . $outputFilePath . ' | exists: ' . ($fileExists ? 'yes' : 'no') . ' | public: ' . $publicFilePath . ' | exists_public: ' . ($fileExistsPublic ? 'yes' : 'no'));
            } else {
                return back()->with('download_links', $downloadLinks);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function convertFromUrl(Request $request)
    {
        // Placeholder: validasi dan proses konversi dari URL bisa dikembangkan di sini
        return back()->with('url_error', 'Fitur konversi dari link/URL akan segera tersedia.');
    }

    public function convertDocuments(Request $request)
    {
        $request->validate([
            'document' => 'required|array',
            'document.*' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,rtf,odt,ods,odp,csv|max:20480', // Max 20MB per file
            'output_format' => 'required|string|in:pdf,docx,jpg,png,txt,zip',
            'pages' => 'nullable|string',
        ]);
        $files = $request->file('document');
        if (!is_array($files)) $files = [$files];
        $outputFormat = $request->output_format;
        $pages = $request->input('pages');
        $downloadLinks = [];
        $downloadPaths = [];
        $zipFiles = [];
        try {
            $validFiles = [];
            foreach ($files as $file) {
                if (
                    $file &&
                    ($file instanceof UploadedFile) &&
                    $file->isValid() &&
                    $file->getClientOriginalName() &&
                    $file->getSize() > 0
                ) {
                    $validFiles[] = $file;
                }
            }
            if (count($validFiles) === 0) {
                return back()->with('doc_error', 'Tidak ada file valid yang diupload.')->with('active_section', 'document')->with('refresh', true);
            }
            foreach ($validFiles as $file) {
                $originalExtension = strtolower($file->getClientOriginalExtension());
                $originalName = $file->getClientOriginalName();
                $originalName = preg_replace('/[^A-Za-z0-9._-]/', '_', $originalName);
                if (!$originalName || trim($originalName) === '' || $originalName === '.pdf' || $originalName === '.docx') {
                    $originalName = 'file-' . uniqid() . '.' . $originalExtension;
                }
                if ($file->getSize() <= 0) continue; // skip file kosong
                // Log debug sebelum storeAs
                \Log::info('DEBUG STORE FILE', [
                    'originalName' => $originalName,
                    'size' => $file->getSize(),
                    'isValid' => $file->isValid(),
                    'exists' => method_exists($file, 'isFile') ? $file->isFile() : 'n/a',
                ]);
                $storedPath = $file->storeAs('temp', uniqid() . '-' . $originalName);
                $fullPath = Storage::path($storedPath);
                // Log setelah upload
                \Log::info('UPLOAD CHECK', [
                    'storedPath' => $storedPath,
                    'exists' => Storage::exists($storedPath),
                    'fullPath' => $fullPath,
                ]);
                if (!Storage::exists($storedPath)) {
                    return back()->with('doc_error', 'File gagal diupload ke server. Silakan coba lagi atau cek permission folder storage/app/temp.')->with('active_section', 'document')->with('refresh', true);
                }
                // Nonaktifkan PDF ke JPG/PNG
                if ($originalExtension === 'pdf' && ($outputFormat === 'jpg' || $outputFormat === 'png')) {
                    return back()->with('doc_error', 'Fitur konversi PDF ke gambar (JPG/PNG) masih dalam tahap pengembangan.')->with('active_section', 'document')->with('refresh', true);
                }
                $downloadLinks[] = Storage::url($storedPath);
                $downloadPaths[] = $storedPath;
                $zipFiles[] = $fullPath;
                // PDF ke JPG/PNG
                if ($originalExtension === 'pdf' && ($outputFormat === 'jpg' || $outputFormat === 'png')) {
                    $pdf = new \Spatie\PdfToImage\Pdf($fullPath);
                    $pageList = range(1, $pdf->getNumberOfPages());
                    foreach ($pageList as $page) {
                        if ($page < 1 || $page > $pdf->getNumberOfPages()) continue;
                        $imgPath = 'temp/' . $originalName . '-page' . $page . '.' . $outputFormat;
                        try {
                            $pdf->setPage($page)->saveImage(storage_path('app/' . $imgPath));
                            $downloadLinks[] = Storage::url($imgPath);
                            $downloadPaths[] = $imgPath;
                            $zipFiles[] = storage_path('app/' . $imgPath);
                        } catch (\Exception $e) {
                            Storage::delete($storedPath);
                            return back()->with('doc_error', 'Gagal konversi halaman ke-' . $page . ': ' . $e->getMessage())->with('active_section', 'document')->with('refresh', true);
                        }
                    }
                    Storage::delete($storedPath);
                }
                // PDF ke TXT
                elseif ($originalExtension === 'pdf' && $outputFormat === 'txt') {
                    $parser = new \Smalot\PdfParser\Parser();
                    $pdf = $parser->parseFile($fullPath);
                    $text = $pdf->getText();
                    $txtPath = 'temp/' . $originalName . '.txt';
                    file_put_contents(storage_path('app/' . $txtPath), $text);
                    $downloadLinks[] = Storage::url($txtPath);
                    $downloadPaths[] = $txtPath;
                    $zipFiles[] = storage_path('app/' . $txtPath);
                    Storage::delete($storedPath);
                }
                // PDF ke DOCX (placeholder)
                elseif ($originalExtension === 'pdf' && $outputFormat === 'docx') {
                    Storage::delete($storedPath);
                    return back()->with('doc_error', 'Konversi PDF ke DOCX belum didukung.')->with('active_section', 'document');
                }
                // DOCX ke PDF
                elseif ($originalExtension === 'docx' && $outputFormat === 'pdf') {
                    try {
                        \Log::info('DOCX2PDF: Mulai konversi', ['fullPath' => $fullPath, 'exists' => file_exists($fullPath), 'size' => filesize($fullPath)]);
                        // Konversi DOCX ke HTML
                        $phpWord = \PhpOffice\PhpWord\IOFactory::load($fullPath);
                        \Log::info('DOCX2PDF: Berhasil load DOCX');
                        $htmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
                        $tmpHtml = storage_path('app/temp/' . uniqid() . '.html');
                        $htmlWriter->save($tmpHtml);
                        \Log::info('DOCX2PDF: Berhasil save HTML', ['tmpHtml' => $tmpHtml, 'exists' => file_exists($tmpHtml)]);
                        if (!file_exists($tmpHtml)) {
                            Storage::delete($storedPath);
                            return back()->with('doc_error', 'Gagal membuat file HTML sementara dari DOCX.')->with('active_section', 'document')->with('refresh', true);
                        }
                        $htmlContent = file_get_contents($tmpHtml);
                        \Log::info('DOCX2PDF: Berhasil baca HTML', ['length' => strlen($htmlContent)]);
                        $pdf = new \Dompdf\Dompdf();
                        $pdf->loadHtml($htmlContent);
                        $pdf->setPaper('A4', 'portrait');
                        $pdf->render();
                        \Log::info('DOCX2PDF: Berhasil render PDF');
                        $pdfPath = 'temp/' . pathinfo($originalName, PATHINFO_FILENAME) . '.pdf';
                        file_put_contents(storage_path('app/' . $pdfPath), $pdf->output());
                        @unlink($tmpHtml);
                        $downloadLinks[] = Storage::url($pdfPath);
                        $downloadPaths[] = $pdfPath;
                        $zipFiles[] = storage_path('app/' . $pdfPath);
                        Storage::delete($storedPath);
                    } catch (\Exception $e) {
                        \Log::error('DOCX2PDF: Exception', ['msg' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
                        Storage::delete($storedPath);
                        return back()->with('doc_error', 'Gagal konversi DOCX ke PDF: ' . $e->getMessage())->with('active_section', 'document')->with('refresh', true);
                    }
                }
                // Lainnya (belum didukung)
                else {
                    Storage::delete($storedPath);
                    return back()->with('doc_error', 'Konversi dari ' . strtoupper($originalExtension) . ' ke ' . strtoupper($outputFormat) . ' belum didukung.')->with('active_section', 'document');
                }
            }
            // Jika multi-file/halaman dan output zip
            if (($outputFormat === 'jpg' || $outputFormat === 'png') && count($zipFiles) > 1 || $outputFormat === 'zip') {
                $zipName = 'converted_documents_' . time() . '.zip';
                $zipPath = storage_path('app/temp/' . $zipName);
                $zip = new \ZipArchive();
                if ($zip->open($zipPath, \ZipArchive::CREATE) === TRUE) {
                    foreach ($zipFiles as $file) {
                        $zip->addFile($file, basename($file));
                    }
                    $zip->close();
                    $downloadLinks = [Storage::url('temp/' . $zipName)];
                    $downloadPaths = ['temp/' . $zipName];
                }
            }
            // Download satu file langsung
            if (count($downloadPaths) === 1) {
                $outputFilePath = storage_path('app/' . $downloadPaths[0]);
                $downloadName = basename($downloadPaths[0]);
                if (!file_exists($outputFilePath)) {
                    \Log::error('File hasil konversi dokumen tidak ditemukan', ['path' => $outputFilePath]);
                    return back()->with('doc_error', 'File hasil konversi tidak ditemukan: ' . $outputFilePath)->with('active_section', 'document')->with('refresh', true);
                }
                // Notifikasi sukses + refresh otomatis
                return back()->with('doc_download_links', $downloadLinks)->with('active_section', 'document')->with('success', 'Konversi berhasil!')->with('refresh', true);
            } else {
                // Notifikasi sukses + refresh otomatis
                return back()->with('doc_download_links', $downloadLinks)->with('active_section', 'document')->with('success', 'Konversi berhasil!')->with('refresh', true);
            }
        } catch (\Exception $e) {
            return back()->with('doc_error', 'Terjadi kesalahan: ' . $e->getMessage())->with('active_section', 'document')->with('refresh', true);
        }
    }

    public function getPdfPages(Request $request)
    {
        \Log::info('getPdfPages called', ['files' => $request->allFiles(), 'inputs' => $request->all()]);
        $request->validate([
            'pdf' => 'required|file|mimes:pdf|max:20480',
        ]);
        if (!$request->hasFile('pdf')) {
            return response()->json(['error' => 'File PDF tidak terkirim ke server.'], 422);
        }
        try {
            // Cek Imagick
            if (!extension_loaded('imagick')) {
                \Log::error('Imagick extension not loaded');
                return response()->json(['error' => 'Ekstensi Imagick belum terpasang di server.'], 500);
            }
            // Cek Ghostscript (khusus Windows, cek via shell_exec)
            $gsCheck = null;
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                $gsCheck = shell_exec('where gswin64c.exe');
                if (!$gsCheck) {
                    \Log::error('Ghostscript (gswin64c.exe) tidak ditemukan di PATH');
                    return response()->json(['error' => 'Ghostscript (gswin64c.exe) tidak ditemukan di PATH environment variable.'], 500);
                }
            } else {
                $gsCheck = shell_exec('which gs');
                if (!$gsCheck) {
                    \Log::error('Ghostscript (gs) tidak ditemukan di PATH');
                    return response()->json(['error' => 'Ghostscript (gs) tidak ditemukan di PATH environment variable.'], 500);
                }
            }
            $file = $request->file('pdf');
            $path = $file->storeAs('temp', uniqid() . '-' . $file->getClientOriginalName());
            $fullPath = storage_path('app/' . $path);
            $pdf = new \Spatie\PdfToImage\Pdf($fullPath);
            $numPages = $pdf->getNumberOfPages();
            \Log::info('PDF page count success', ['file' => $fullPath, 'pages' => $numPages]);
            Storage::delete($path);
            return response()->json(['pages' => $numPages]);
        } catch (\Exception $e) {
            \Log::error('PDF Page Count Error', ['exception' => $e, 'trace' => $e->getTraceAsString()]);
            return response()->json(['error' => 'Gagal membaca PDF: ' . $e->getMessage()], 422);
        }
    }

    private function getFileType($extension)
    {
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'tiff', 'ico', 'svg', 'heic'];
        $documentExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'rtf'];
        $videoExtensions = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'mkv', 'webm'];
        $audioExtensions = ['mp3', 'wav', 'flac', 'aac', 'ogg', 'm4a', 'wma'];

        if (in_array(strtolower($extension), $imageExtensions)) {
            return 'image';
        } elseif (in_array(strtolower($extension), $documentExtensions)) {
            return 'document';
        } elseif (in_array(strtolower($extension), $videoExtensions)) {
            return 'video';
        } elseif (in_array(strtolower($extension), $audioExtensions)) {
            return 'audio';
        }

        return null;
    }

    private function convertImage($inputPath, $outputPath, $outputFormat)
    {
        $image = Image::make(Storage::path($inputPath));
        
        // Optimize image quality
        $quality = 80;
        
        switch ($outputFormat) {
            case 'jpg':
            case 'jpeg':
                $image->encode('jpg', $quality);
                break;
            case 'png':
                $image->encode('png', $quality);
                break;
            case 'webp':
                $image->encode('webp', $quality);
                break;
            case 'gif':
                $image->encode('gif');
                break;
            default:
                throw new \Exception('Format gambar tidak didukung');
        }

        Storage::put($outputPath, $image->encode());
    }

    private function convertDocument($inputPath, $outputPath, $outputFormat)
    {
        $inputFullPath = Storage::path($inputPath);
        $outputFullPath = Storage::path($outputPath);

        switch ($outputFormat) {
            case 'pdf':
                if (in_array(pathinfo($inputPath, PATHINFO_EXTENSION), ['doc', 'docx'])) {
                    // Convert DOC/DOCX to PDF
                    $phpWord = IOFactory::load($inputFullPath);
                    $pdfWriter = IOFactory::createWriter($phpWord, 'PDF');
                    $pdfWriter->save($outputFullPath);
                } else {
                    throw new \Exception('Konversi ke PDF hanya didukung untuk file DOC/DOCX');
                }
                break;
            case 'docx':
                if (pathinfo($inputPath, PATHINFO_EXTENSION) === 'pdf') {
                    // Convert PDF to DOCX
                    $dompdf = new Dompdf();
                    $dompdf->loadHtml(file_get_contents($inputFullPath));
                    $dompdf->setPaper('A4', 'portrait');
                    $dompdf->render();
                    
                    $phpWord = new PhpWord();
                    $section = $phpWord->addSection();
                    $section->addText($dompdf->output());
                    
                    $docxWriter = IOFactory::createWriter($phpWord, 'Word2007');
                    $docxWriter->save($outputFullPath);
                } else {
                    throw new \Exception('Konversi ke DOCX hanya didukung untuk file PDF');
                }
                break;
            default:
                throw new \Exception('Format dokumen tidak didukung');
        }
    }

    private function convertVideo($inputPath, $outputPath, $outputFormat)
    {
        $ffmpeg = FFMpeg::create([
            'ffmpeg.binaries' => '/usr/bin/ffmpeg',
            'ffprobe.binaries' => '/usr/bin/ffprobe',
            'timeout' => 3600,
            'ffmpeg.threads' => 12,
        ]);

        $video = $ffmpeg->open(Storage::path($inputPath));
        
        // Set video format and codec
        $format = new \FFMpeg\Format\Video\X264();
        $format->setKiloBitrate(1000);
        
        $video->save($format, Storage::path($outputPath));
    }

    private function convertAudio($inputPath, $outputPath, $outputFormat)
    {
        $ffmpeg = FFMpeg::create([
            'ffmpeg.binaries' => '/usr/bin/ffmpeg',
            'ffprobe.binaries' => '/usr/bin/ffprobe',
            'timeout' => 3600,
        ]);

        $audio = $ffmpeg->open(Storage::path($inputPath));
        
        // Set audio format and quality
        $format = new \FFMpeg\Format\Audio\Mp3();
        $format->setAudioKiloBitrate(128);
        
        $audio->save($format, Storage::path($outputPath));
    }

    private function convertImageBatch($inputPath, $outputPath, $outputFormat, $quality = 80, $resizeWidth = null, $resizeHeight = null)
    {
        $image = Image::make(Storage::path($inputPath));
        if ($resizeWidth || $resizeHeight) {
            $image->resize($resizeWidth, $resizeHeight, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }
        switch ($outputFormat) {
            case 'jpg':
            case 'jpeg':
                $image->encode('jpg', $quality);
                break;
            case 'png':
                $image->encode('png', $quality);
                break;
            case 'webp':
                $image->encode('webp', $quality);
                break;
            case 'gif':
                $image->encode('gif');
                break;
            default:
                throw new \Exception('Format gambar tidak didukung');
        }
        Storage::put($outputPath, $image->encode());
    }
}
