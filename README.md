<div align="center">

# 📚 Sistem Manajemen Perpustakaan Digital

![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

<p align="center">
  <b>Sistem informasi perpustakaan modern, responsif, dan elegan.</b><br>
  Dibangun untuk efisiensi, keindahan visual, dan kemudahan penggunaan bagi pemula hingga profesional.
</p>

</div>

---

## 👋 Halo! Selamat Datang

Aplikasi ini adalah **Sistem Perpustakaan Digital** yang dibuat menggunakan teknologi web terbaru (**Laravel 11**). Tujuan aplikasi ini adalah membantu sekolah atau instansi mengelola buku, anggota, dan peminjaman dengan mudah tanpa ribet mencatat di kertas.

### ✨ Mengapa Aplikasi Ini Beda?
- **Tampilan Modern**: Tidak kaku seperti aplikasi pemerintah jadul. Enak dipandang dan mudah dimengerti.
- **Anti Ribet**: Menghitung denda otomatis, stok buku berkurang otomatis saat dipinjam.
- **Siap Pakai**: Sudah ada fitur laporan PDF siap cetak.

---

## ⚡ Panduan Instalasi (Untuk Pemula)

Jangan khawatir jika kamu belum pernah menginstall aplikasi Laravel sebelumnya. Ikuti langkah-langkah di bawah ini pelan-pelan ya!

### 📋 1. Persiapan (Wajib Punya)
Pastikan komputer kamu sudah terinstall aplikasi berikut:
*   **XAMPP / Laragon** (Untuk database MySQL & PHP).
*   **Composer** (Untuk install library PHP). [Download disini](https://getcomposer.org/)
*   **Node.js** (Untuk mengatur tampilan/CSS). [Download disini](https://nodejs.org/)

### 🛠️ 2. Langkah Instalasi

**Langkah 1: Download Kodingan**
Buka terminal (Command Prompt / Git Bash) di folder dimana kamu mau menyimpan project ini, lalu ketik:
```bash
# 1. Clone Repository
git clone https://github.com/halfthew0rldaway/manajemen-perpustakaan-digital.git
cd manajemen-perpustakaan-digital

**Langkah 2: Install "Bahan-Bahan" Pendukung**
Aplikasi ini butuh beberapa library tambahan agar bisa jalan. Jalankan perintah ini dan tunggu sampai selesai:
```bash
# Install library PHP
composer install

# Install library JavaScript/Tampilan
npm install
```

**Langkah 3: Atur Konfigurasi**
Kita perlu membuat file pengaturan. Cukup copy dari contoh yang sudah ada:
```bash
cp .env.example .env
```
_Tips: Jika error di Windows, coba copy manual file `.env.example` lalu rename jadi `.env`._

**Langkah 4: Generate Kunci Keamanan**
Agar aplikasi aman, kita perlu generate "key" rahasia:
```bash
php artisan key:generate
```

**Langkah 5: Buat Database**
1. Nyalakan **Apache** dan **MySQL** di XAMPP/Laragon kamu.
2. Buka browser, masuk ke `localhost/phpmyadmin`.
3. Buat database baru dengan nama: **perpustakaan** (atau nama lain bebas).
4. **PENTING**: Buka file `.env` di text editor (VSCode/Notepad), cari bagian ini dan sesuaikan:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=perpustakaan  <-- Ganti sesuai nama database yg kamu buat
   DB_USERNAME=root          <-- Default XAMPP biasanya 'root'
   DB_PASSWORD=              <-- Default XAMPP biasanya kosong
   ```

**Langkah 6: Masukkan Data Otomatis (Migrate & Seed)**
Perintah ini akan membuat tabel-tabel dan mengisi data palsu (dummy) supaya aplikasi tidak kosong melompong saat pertama dibuka.
```bash
php artisan migrate:fresh --seed
```

**Langkah 7: Jalankan Aplikasi 🚀**
Kamu butuh **2 Terminal** yang jalan bersamaan:

*Terminal 1 (Untuk menjalankan server PHP):*
```bash
php artisan serve
```

*Terminal 2 (Untuk memproses tampilan/CSS):*
```bash
npm run dev
```

Buka browser dan akses: `http://127.0.0.1:8000`

---

## 🔑 Akun Login (Demo)

Setelah install, kamu bisa langsung masuk menggunakan akun-akun ini:

| Peran | Email | Password | Hak Akses |
| :--- | :--- | :--- | :--- |
| **👑 Administrator** | `admin@perpus.digital` | `password` | Bisa segalanya (Kelola User, Buku, Laporan) |
| **👮 Petugas** | `staff@perpus.digital` | `password` | Hanya bisa transaksi Peminjaman & Laporan |

---

## 🌟 Fitur Unggulan

| Modul | Keunggulan |
| :--- | :--- |
| **Stok Pintar 🛡️** | **Baru!** Tidak bisa input buku baru cuma 1 biji (Minimal 2). Stok otomatis berkurang saat dipinjam. |
| **Denda Otomatis 💸** | Telat balikin buku? Sistem otomatis hitung denda **Rp 2.000/hari**. Gak perlu hitung manual pake kalkulator. |
| **Cetak Laporan 🖨️** | Laporan harian & denda bisa langsung diprint ke PDF format A4. Rapi dan resmi. |

---

## ❓ Masalah yang Sering Muncul (FAQ)

**Q: Kok tampilannya berantakan/putih polosan?**
A: Pastikan kamu sudah menjalankan perintah `npm run dev` di terminal kedua. Aplikasi ini butuh itu supaya desainnya muncul.

**Q: Error "Unknown Database"?**
A: Kamu belum buat database di phpMyAdmin, atau nama database di file `.env` salah ketik. Cek lagi Langkah 5.

**Q: Error "Table not found"?**
A: Lupa menjalankan migrasi. Coba ketik `php artisan migrate:fresh --seed`.

---

<div align="center">

**Dibuat oleh wizzy**
<br>
_Educational Purpose Only - Selamat Belajar!_ 🚀

</div>
