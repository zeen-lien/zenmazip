<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Landing Page Utama
Route::get('/', function () {
    return view('halaman-utama');
})->name('halaman-utama');

// Rute untuk Halaman Konversi File
Route::get('/konversi', [App\Http\Controllers\KonversiController::class, 'index'])->name('konversi-file');
Route::post('/konversi/images', [App\Http\Controllers\KonversiController::class, 'convertImages'])->name('konversi-images');
Route::post('/konversi/url', [App\Http\Controllers\KonversiController::class, 'convertFromUrl'])->name('konversi-url');
Route::post('/konversi/documents', [App\Http\Controllers\KonversiController::class, 'convertDocuments'])->name('konversi-documents');
Route::post('/konversi/pdf-pages', [App\Http\Controllers\KonversiController::class, 'getPdfPages'])->name('konversi-pdf-pages');

// Rute untuk Halaman Kompresi File
Route::get('/kompresi', [App\Http\Controllers\KompresiController::class, 'index'])->name('kompresi-file');
Route::post('/kompresi/zip', [App\Http\Controllers\KompresiController::class, 'kompresiZip'])->name('kompresi-zip');
