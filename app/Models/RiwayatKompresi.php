<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatKompresi extends Model
{
    use HasFactory;

    protected $table = 'riwayat_kompresi';
    
    protected $fillable = [
        'nama_file',
        'format_file',
        'ukuran_asal',
        'ukuran_hasil',
        'path_file_asal',
        'path_file_hasil',
        'level_kompresi',
        'status',
        'keterangan'
    ];
} 