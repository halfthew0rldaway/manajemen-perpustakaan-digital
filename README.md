# AI Agent – UAS Project Documentation

## 1. Project Overview

This project is a locally running AI-powered web application developed as a **Final Semester Project (UAS)** for the *Pemrograman Web Lanjut* course. The system is built using **Laravel (v9+)** and follows modern web development best practices, including clean architecture, secure coding, maintainable logic, and a professional UI/UX design.

The goal of this project is not only to meet functional requirements, but also to demonstrate proper software engineering principles such as separation of concerns, data integrity, security hardening, and scalability readiness, even though the application is intended to run locally.

## 2. Technology Stack

### Backend

* **Laravel 9+** (MVC architecture)
* **PHP 8.1+**
* **MySQL** (Relational Database)
* **Eloquent ORM**
* **Migration & Seeder** for schema and initial data

### Frontend

* **Blade Templating Engine**
* **Tailwind CSS** for utility-first styling
* **Alpine.js** for lightweight interactivity
* **Vite** for asset bundling

This stack is chosen to balance **performance**, **developer productivity**, and **clean UI rendering**, while remaining fully compatible with Laravel standards.

## 3. Application Architecture

The application strictly follows Laravel's **MVC pattern**:

* **Models** handle data relationships, business rules, and query scopes
* **Controllers** manage request validation, authorization, and orchestration
* **Views (Blade)** are kept logic-free and focus only on presentation

Additional architectural principles applied:

* Single Responsibility Principle (SRP)
* Fat Model, Thin Controller
* Route-level access control
* Service abstraction for complex logic (where applicable)

## 4. Core Logic & Workflow

### Authentication & Authorization

* Role-based access control (Admin & Petugas)
* Middleware-protected routes
* Secure password hashing using Laravel's built-in bcrypt

### Data Integrity

* Foreign key constraints enforced via migrations
* Validation rules on both client and server side
* Unique constraints to prevent duplicate records

### Transaction Safety

* Database transactions are used for critical operations such as loans and returns
* Automatic rollback on failure

### Error Handling

* Centralized validation handling
* User-friendly error feedback
* No sensitive error data exposed to the UI

## 5. Security Considerations

Even though this project runs locally, proper security practices are still implemented:

* CSRF protection on all forms
* Input sanitization and validation
* Mass assignment protection via `$fillable`
* Route protection via middleware
* No hardcoded credentials
* Environment variables stored in `.env`

These measures ensure the application is safe, predictable, and aligned with real-world development standards.

## 6. UI / UX Design Principles

### Design Goals

* Clean, professional, and non-distracting
* Responsive across desktop, tablet, and mobile
* Clear visual hierarchy

### Color Scheme (60–30–10 Rule)

* **60%** Neutral background (dark gray / off-white depending on mode)
* **30%** Primary brand color (deep blue or muted red)
* **10%** Accent color for actions and highlights

No AI-generated flashy gradients or oversaturated colors are used. The palette is intentionally restrained and readable.

### Typography

* Primary Font: **Inter** or **Poppins**
* High readability
* Consistent spacing and font scale

### UX Details

* Clear call-to-action buttons
* Consistent spacing system
* Accessible contrast ratios
* Subtle transitions without over-animation

## 7. Responsiveness

* Mobile-first approach
* Flexbox and Grid layout
* Adaptive tables and forms
* No horizontal scrolling on small screens

## 8. Database Design

### Database Engine

Aplikasi ini menggunakan **MySQL / MariaDB** sebagai database utama, sesuai dengan ketentuan UAS dan untuk memastikan dukungan penuh terhadap relasi, foreign key, dan constraint.

Seluruh migration dan seeder dirancang **MySQL-friendly**, dengan memperhatikan:

* Tipe data yang kompatibel (InnoDB)
* Foreign key constraint aktif
* Index dan unique constraint yang konsisten

### Struktur Tabel

Tables used:

* `users`
* `books`
* `loans`

Relationships:

* One user → many loans
* One book → many loans

Seluruh relasi diterapkan pada level database menggunakan foreign key dan juga direpresentasikan di level aplikasi melalui Eloquent relationship.

### Migration & Seeder

* Seluruh tabel dibuat menggunakan **Laravel Migration**
* Engine tabel diset ke **InnoDB** untuk mendukung foreign key
* Seeder disediakan untuk data awal (minimal 5 buku)
* Proses migrasi dan seeding diuji menggunakan MySQL lokal

Untuk menjalankan migration dan seeder:

```
php artisan migrate
php artisan db:seed
```

Tidak ada dependensi SQLite pada project ini. Seluruh pengujian dilakukan menggunakan MySQL.

## 9. Variasi Studi Kasus & Fitur Berdasarkan NIM

**NIM:** 411231088

### Variasi Studi Kasus (2 Digit Terakhir: 88)

Sistem yang dibangun adalah **Sistem Perpustakaan Digital**, yaitu pengembangan dari sistem perpustakaan konvensional yang berfokus pada pengelolaan data buku, peminjaman, dan pengembalian secara terpusat dan terintegrasi melalui aplikasi web.

Pada sistem perpustakaan digital ini, seluruh proses pencatatan dilakukan secara digital tanpa pencatatan manual, sehingga meminimalkan kesalahan input dan meningkatkan efisiensi pengelolaan data.

Entitas utama yang digunakan:

* `users`
* `books`
* `loans`

Relasi:

* Satu user dapat memiliki banyak data peminjaman
* Satu buku dapat dipinjam berkali-kali oleh user yang berbeda

Seluruh relasi diterapkan menggunakan foreign key dan Eloquent relationship.

### Aturan Validasi Stok Buku

Pada sistem Perpustakaan Digital ini diterapkan aturan khusus terkait manajemen stok buku sebagai berikut:

* Saat **menambahkan buku baru**, stok **tidak diperbolehkan bernilai 0 atau 1**. Sistem mewajibkan **stok awal minimal 2** untuk memastikan buku layak dipinjam.
* Aturan ini divalidasi di sisi backend (controller) dan database.
* Untuk **penambahan stok selanjutnya (restock)**, jumlah stok **dibebaskan** tanpa batas minimal, karena buku sudah terdaftar secara valid di sistem.

Aturan ini dibuat untuk menjaga konsistensi data dan mencegah entri buku yang tidak dapat dipinjam sejak awal.

### Variasi Fitur (1 Digit Terakhir: 8)

Berdasarkan variasi NIM, fitur tambahan yang diterapkan adalah sebagai berikut:

1. **Batas Maksimal Peminjaman Buku**
   Setiap user hanya diperbolehkan meminjam maksimal **4 buku aktif** secara bersamaan. Sistem akan menolak transaksi jika batas terlampaui.

2. **Fitur Denda Keterlambatan**
   Jika pengembalian melewati tanggal jatuh tempo, sistem otomatis menghitung denda sebesar **Rp2.000 per hari keterlambatan**.

3. **Laporan Peminjaman Harian**
   Sistem menyediakan laporan jumlah peminjaman buku per hari yang dapat diakses oleh Admin sebagai bahan monitoring.

Seluruh fitur variasi di atas diimplementasikan langsung di dalam logic backend dan divalidasi di level controller serta database.

## 10. Fitur Pengembangan Lanjutan (Update Terbaru)

Berikut adalah fitur-fitur tambahan yang telah diimplementasikan untuk meningkatkan fungsionalitas dan UX aplikasi:

### Manajemen Kategori Modern
* Migrasi sistem kategori dari kolom teks sederhana menjadi tabel relasional `categories`.
* Fitur **Sinkronisasi Otomatis** untuk data lama.
* CRUD Kategori lengkap.

### Pencarian & Filter Canggih
* Multi-column search (Judul, Penulis, ISBN, Penerbit).
* Filter kombinasi: Kategori + Tahun + Ketersediaan.
* Sorting data (A-Z, Terbaru, Stok).

### Laporan & Export
* **Export CSV** untuk Laporan Harian dan Keterlambatan.
* Kalkulasi denda real-time pada laporan.
* Navigasi laporan yang lebih intuitif.

### UI/UX Polish
* Notifikasi sistem (Toast) yang elegan.
* Animasi transisi yang halus.
* Konsistensi desain tombol dan kartu.

### Setup Data Baru
Untuk melakukan sinkronisasi kategori lama dan generate dummy data baru:

```bash
php artisan app:sync-categories --dummy
```

## 11. Development Best Practices

1. Clone the repository
2. Install dependencies using Composer and NPM
3. Configure `.env`
4. Run migrations and seeders
5. Start the local server

The application is now ready to run locally.

## 12. Limitations

* Designed for local execution only
* No external API calls
* No production deployment configuration

These limitations are intentional and aligned with the scope of the UAS project.

## 13. Conclusion

This project is built to demonstrate not only functional correctness but also **professional-level code quality**, **secure logic**, and **modern UI/UX standards**. It reflects how a real-world Laravel application should be structured, even within an academic environment.

---

**Author:** [Your Name]
**Course:** Pemrograman Web Lanjut
**Academic Year:** 2025/2026
