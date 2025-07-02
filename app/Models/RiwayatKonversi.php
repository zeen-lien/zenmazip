<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatKonversi extends Model
{
    use HasFactory;

    protected $table = 'riwayat_konversi';
    
    protected $fillable = [
        'nama_file',
        'format_asal',
        'format_tujuan',
        'ukuran_asal',
        'ukuran_hasil',
        'path_file_asal',
        'path_file_hasil',
        'status',
        'keterangan'
    ];
} 