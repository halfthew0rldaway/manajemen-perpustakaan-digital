<div align="center">

# Sistem Manajemen Perpustakaan Digital 📚

![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

<p align="center">
  <b>Sistem informasi perpustakaan modern, responsif, dan elegan.</b><br>
  Dibangun untuk efisiensi, keindahan visual, dan kemudahan penggunaan.
</p>

</div>

---

## ✨ Tentang Aplikasi

Perpustakaan Digital adalah solusi manajemen perpustakaan _end-to-end_ yang dirancang dengan **Laravel 11**. Tidak seperti aplikasi CRUD biasa, aplikasi ini berfokus pada **User Experience (UX)** premium dengan animasi halus, desain _card-based_ yang bersih, dan _workflow_ yang intuitif.

### 🌟 Fitur Unggulan

| Modul | Deskripsi & Keunggulan |
| :--- | :--- |
| **🔐 Autentikasi** | Login page modern dengan validasi realtime, toggle password, dan _hidden demo drawer_. |
| **👥 Anggota** | Manajemen data anggota lengkap dengan **Auto-Avatar Generator** (inisial nama). |
| **📖 Buku** | Katalog buku dengan kategori dinamis, tracking stok otomatis, dan pencarian cepat. |
| **🔄 Peminjaman** | Kalkulasi tanggal **Jatuh Tempo Otomatis** (+7 hari) dan validasi stok realtime. |
| **💸 Denda** | Perhitungan denda **Rp 2.000/hari** secara otomatis tanpa *bug* angka negatif. |
| **📄 Laporan** | **Cetak PDF Terformat** (A4) langsung dari browser dan ekspor data ke Excel/CSV. |

---

## 🎨 Design System & UI

Aplikasi ini tidak menggunakan template bawaan, melainkan **Design System Custom** yang dibangun di atas Tailwind CSS 3.4.

*   **Typography**: Kombinasi elegan **Source Serif 4** (Judul) dan **Inter** (Body).
*   **Warna**: Palet warna pastel modern dipadukan dengan aksen kontras untuk aksi utama.
*   **3D Buttons**: Tombol dengan efek _tactile_ (3D) yang memberikan kepuasan saat diklik.
*   **Modal Kustom**: Dialog konfirmasi (`confirmModal`) yang lebih profesional daripada `alert()` browser biasa.

---

## 🚀 Alur Kerja (Workflow)

### 1. Peminjaman Buku 📤
1.  Petugas memilih **Anggota** & **Buku** di menu "Buat Peminjaman".
2.  Sistem memverifikasi stok buku & kuota pinjam anggota.
3.  Klik **Simpan**. Stok buku berkurang, status peminjaman "Aktif".

### 2. Pengembalian & Denda 📥
1.  Cari transaksi di daftar peminjaman.
2.  Klik tombol **Kembalikan** (Teal).
3.  Jika terlambat, sistem otomatis menghitung: `(Hari Terlambat) x Rp 2.000`.
4.  Stok buku kembali bertambah.

### 3. Pelaporan Harian 🖨️
1.  Admin membuka menu **Laporan Harian**.
2.  Filter tanggal laporan.
3.  Klik **Cetak PDF** (Tombol Hitam).
4.  Dokumen A4 siap cetak muncul di tab baru.

---

## 🛠️ Instalasi Lokal

Ingin menjalankan di komputer Anda? Ikuti langkah mudah ini:

### Prasyarat
*   PHP >= 8.2
*   Composer
*   Node.js & NPM
*   MySQL

### Langkah Instalasi
```bash
# 1. Clone Repository
git clone https://github.com/halfthew0rldaway/manajemen-perpustakaan-digital.git
cd manajemen-perpustakaan-digital

# 2. Install Backend & Frontend Dependencies
composer install
npm install

# 3. Konfigurasi Environment
cp .env.example .env
php artisan key:generate
# (Edit file .env dan sesuaikan DB_DATABASE, DB_USERNAME, dll)

# 4. Setup Database & Data Dummy
php artisan migrate:fresh --seed
# (Otomatis mengisi data buku, anggota, dan transaksi contoh)

# 5. Jalankan Aplikasi
npm run build
php artisan serve
```
Akses aplikasi di: `http://127.0.0.1:8000`

---

## 🔑 Akses Demo

Kami menyediakan data *dummy* agar Anda bisa langsung mencoba semua fitur:

| Akun | Email | Password | Akses |
| :--- | :--- | :--- | :--- |
| **Administrator** | `admin@perpus.digital` | `password` | Full Akses (Kelola User & Master Data) |
| **Petugas Staff** | `staff@perpus.digital` | `password` | Manajemen Peminjaman & Laporan |

---

<div align="center">

**Dibuat oleh wizzy untuk kemudahan manajemen perpustakaan.**
<br>
_Terima kasih telah menggunakan aplikasi ini!_ 🚀

</div>
