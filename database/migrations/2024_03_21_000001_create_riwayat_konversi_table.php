<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('riwayat_konversi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_file');
            $table->string('format_asal');
            $table->string('format_tujuan');
            $table->string('ukuran_asal');
            $table->string('ukuran_hasil');
            $table->string('path_file_asal');
            $table->string('path_file_hasil');
            $table->string('status')->default('selesai');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('riwayat_konversi');
    }
}; 