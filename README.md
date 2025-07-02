# Zenmazip - File Converter & Media Downloader

Zenmazip adalah aplikasi web untuk konversi file dan download media dari berbagai platform. Aplikasi ini dibangun menggunakan Laravel 10 dan menawarkan berbagai fitur konversi file serta download media dari platform populer.

## Fitur Utama

### Status Fitur

| Fitur                                 | Status            | Keterangan                                    |
|---------------------------------------|-------------------|-----------------------------------------------|
| Konversi Gambar (JPG, PNG, WEBP, GIF) | ✔️ Sudah Bisa     | Upload & konversi gambar                      |
| Konversi Dokumen (PDF, DOCX, TXT)     | ✔️ Sudah Bisa     | Upload & konversi dokumen                     |
| DOCX ke PDF                           | ✔️ Sudah Bisa     |                                              |
| PDF ke TXT                            | ✔️ Sudah Bisa     |                                              |
| Ambil jumlah halaman PDF              | ✔️ Sudah Bisa     |                                              |
| Kompresi File ke ZIP                  | ✔️ Sudah Bisa     | Upload beberapa file, kompres ke ZIP          |
| Konversi dari URL                     | ⏳ Dalam Pengembangan | Placeholder, belum berjalan               |
| PDF ke JPG/PNG                        | ⏳ Dalam Pengembangan | Notifikasi: fitur belum tersedia          |
| PDF ke DOCX                           | ❌ Belum Tersedia | Notifikasi: fitur belum tersedia              |
| Konversi video/audio                  | ❌ Belum Tersedia | Belum ada implementasi di kode                |
| Download media sosial (YouTube, dsb)  | ❌ Belum Tersedia | Belum ada implementasi di kode                |

### 1. Konversi File
- **Dokumen**
  - PDF → DOCX, DOCX → PDF, TXT → PDF
  - Konversi dokumen dengan kualitas tinggi
  - Dukungan format: PDF, DOCX, DOC, TXT

- **Gambar**
  - JPG → PNG, PNG → JPG, WEBP → JPG
  - Konversi gambar dengan kualitas tinggi
  - Dukungan format: JPG, PNG, WEBP

- **Video**
  - MP4 → MP3, MP4 → GIF
  - Konversi video dengan kualitas tinggi
  - Dukungan format: MP4, MP3, GIF

- **Musik**
  - MP3 → WAV, WAV → MP3
  - Konversi musik dengan kualitas tinggi
  - Dukungan format: MP3, WAV

### 2. Konversi dari Media Sosial
- **TikTok**
  - Download video TikTok
  - Konversi ke MP4/MP3

- **YouTube**
  - Download video YouTube
  - Konversi ke MP4/MP3

- **Instagram**
  - Download video Instagram
  - Konversi ke MP4/MP3

## Cara Pakai

### Konversi File
1. Klik "Konversi" di homepage
2. Pilih kategori konversi (dokumen, gambar, video, musik)
3. Upload file yang ingin dikonversi
4. Pilih format output
5. Klik "Konversi"
6. Download hasil konversi

### Konversi dari Media Sosial
1. Klik "Konversi" di homepage
2. Pilih "Konversi dari Media Sosial"
3. Paste link media sosial (TikTok, YouTube, Instagram)
4. Pilih format output (MP4/MP3)
5. Klik "Konversi"
6. Download hasil konversi

## Teknologi yang Digunakan

### Backend
- **Laravel 10** - Framework PHP
- **PHP 8.1+** - Bahasa pemrograman
- **MySQL** - Database
- **Composer** - Package manager

### Package PHP
- **smalot/pdfparser** - Parse PDF
- **phpoffice/phpword** - Generate DOCX
- **tecnickcom/tcpdf** - Generate PDF
- **intervention/image** - Konversi gambar
- **youtube-dl** - Download video dari media sosial
- **ffmpeg** - Konversi video/audio

### Frontend
- **HTML5** - Struktur halaman
- **CSS3** - Styling
- **JavaScript** - Interaktivitas
- **Bootstrap 5** - Framework CSS
- **jQuery** - Library JavaScript

## Instalasi

### Prasyarat
- PHP 8.1 atau lebih tinggi
- Composer
- MySQL
- Node.js & NPM
- youtube-dl (untuk download video)
- ffmpeg (untuk konversi video/audio)

### Langkah Instalasi
1. Clone repository
   ```bash
   git clone https://github.com/username/zenmazip.git
   cd zenmazip
   ```

2. Install dependencies
   ```bash
   composer install
   npm install
   ```

3. Setup environment
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Konfigurasi database di `.env`
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=zenmazip
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. Jalankan migrasi
   ```bash
   php artisan migrate
   ```

6. Install youtube-dl dan ffmpeg
   ```bash
   # Windows (via Chocolatey)
   choco install youtube-dl ffmpeg

   # Linux
   sudo apt-get install youtube-dl ffmpeg
   ```

7. Jalankan server
   ```bash
   php artisan serve
   ```

8. Build assets
   ```bash
   npm run dev
   ```

## Struktur Aplikasi

### Halaman
- **Homepage** - Landing page utama
- **Landing Page Konversi** - Penjelasan fitur konversi
- **Halaman Konversi** - Pilih kategori konversi
- **Proses Konversi** - Upload file/paste link, pilih format, konversi

### Controller
- **KonversiController** - Handle konversi file
- **MediaController** - Handle konversi dari media sosial

### Model
- **User** - Model user
- **File** - Model file hasil konversi

## Kontribusi
Silakan buat pull request untuk kontribusi. Untuk perubahan besar, buka issue terlebih dahulu untuk diskusi.

## Lisensi
[MIT](https://choosealicense.com/licenses/mit/)

---

# Manual Book (Panduan Penggunaan)

## A. Deskripsi Singkat Aplikasi
Aplikasi ini adalah web berbasis Laravel yang menyediakan fitur konversi dan kompresi file. Pengguna dapat mengunggah file untuk dikonversi (gambar, dokumen, PDF, atau dari URL) dan mengompres file menjadi ZIP.

## B. Cara Menggunakan Aplikasi

### 1. Mengakses Halaman Utama
- Buka browser dan akses alamat utama aplikasi (misal: `http://localhost:8000/`).
- Akan tampil halaman utama aplikasi.

### 2. Fitur Konversi File
- Klik menu/tautan **Konversi** atau akses `http://localhost:8000/konversi`.
- Akan muncul form konversi file.
- Pilih jenis konversi yang diinginkan:
  - **Konversi Gambar:**  
    - Klik tombol upload gambar.
    - Pilih file gambar dari komputer Anda.
    - Klik tombol "Konversi".
    - Tunggu proses selesai, lalu unduh hasil konversi.
  - **Konversi dari URL:**  
    - Masukkan URL file yang ingin dikonversi.
    - Klik tombol "Konversi".
    - Tunggu proses selesai, lalu unduh hasil konversi. (Fitur ini masih dalam pengembangan)
  - **Konversi Dokumen:**  
    - Klik tombol upload dokumen.
    - Pilih file dokumen dari komputer Anda.
    - Klik tombol "Konversi".
    - Tunggu proses selesai, lalu unduh hasil konversi.
  - **Ambil Halaman PDF:**  
    - Upload file PDF.
    - Pilih halaman yang ingin diambil.
    - Klik tombol "Ambil Halaman".
    - Unduh hasilnya.

### 3. Fitur Kompresi File
- Klik menu/tautan **Kompresi** atau akses `http://localhost:8000/kompresi`.
- Akan muncul form kompresi file.
- Klik tombol upload file.
- Pilih file yang ingin dikompresi.
- Klik tombol "Kompresi".
- Tunggu proses selesai, lalu unduh file ZIP hasil kompresi.

## C. Catatan
- Pastikan file yang diunggah sesuai dengan format yang didukung aplikasi.
- Jika terjadi error, periksa kembali ukuran dan tipe file.
- Untuk keamanan, jangan mengunggah file yang mengandung virus/malware.

## D. Kontak Bantuan
Jika mengalami kendala, hubungi admin/pengembang aplikasi melalui email atau kontak yang tersedia di halaman utama.
