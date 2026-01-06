# Panduan Setup Sistem Perpustakaan Digital

## ✅ Status Implementasi: LENGKAP

### Yang Sudah Dibuat:

#### 1. Database & Models ✅
- ✅ Migration untuk tabel `users` (dengan role: admin/petugas)
- ✅ Migration untuk tabel `books` (dengan validasi stok minimal 2)
- ✅ Migration untuk tabel `loans` (dengan status dan fine_amount)
- ✅ Model `Book` dengan relationships dan helper methods
- ✅ Model `Loan` dengan perhitungan denda (Rp2.000/hari)
- ✅ Model `User` dengan validasi batas peminjaman (max 4 buku)

#### 2. Seeders ✅
- ✅ `UserSeeder` - 1 Admin + 2 Petugas
- ✅ `BookSeeder` - 8 buku dengan stok >= 2
- ✅ `DatabaseSeeder` - orchestrator

#### 3. Controllers ✅
- ✅ `BookController` - CRUD buku dengan validasi stok
- ✅ `LoanController` - Peminjaman, pengembalian, perhitungan denda
- ✅ `DashboardController` - Statistik dan laporan harian
- ✅ `LoginController` - Authentication

#### 4. Middleware ✅
- ✅ `IsAdmin` - Role-based access control
- ✅ Registered in bootstrap/app.php

#### 5. Routes ✅
- ✅ Authentication routes (login/logout)
- ✅ Protected routes dengan middleware auth
- ✅ Resource routes untuk books dan loans
- ✅ Routes untuk laporan

#### 6. Views (Blade Templates) ✅
- ✅ Layout utama (layouts/app.blade.php)
- ✅ Login page (auth/login.blade.php)
- ✅ Dashboard (dashboard.blade.php)
- ✅ Books Index (books/index.blade.php)
- ✅ Books Create (books/create.blade.php)
- ✅ Loans Index (loans/index.blade.php)
- ✅ Loans Create (loans/create.blade.php)
- ✅ Daily Report (reports/daily.blade.php)

#### 7. Frontend ✅
- ✅ Tailwind CSS (via CDN)
- ✅ Alpine.js (via CDN)
- ✅ Responsive design
- ✅ Professional UI/UX

#### 8. Setup Scripts ✅
- ✅ `setup.sh` - Script otomatis instalasi

## Cara Setup

### Opsi 1: Menggunakan Script Otomatis (Recommended)

```bash
chmod +x setup.sh
./setup.sh
```

### Opsi 2: Manual

```bash
# 1. Install dependencies
composer install
npm install

# 2. Setup environment
cp .env.example .env
php artisan key:generate

# 3. Setup database (SQLite)
touch database/database.sqlite

# 4. Update .env untuk menggunakan SQLite
# Ubah DB_CONNECTION=mysql menjadi DB_CONNECTION=sqlite
# Hapus atau comment DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 5. Run migrations dan seeders
php artisan migrate:fresh --seed

# 6. Build assets (optional, karena menggunakan CDN)
npm run build

# 7. Start server
php artisan serve
```

## Kredensial Login

Setelah seeding, gunakan kredensial berikut:

- **Admin**: admin@perpustakaan.test / password
- **Petugas 1**: petugas1@perpustakaan.test / password
- **Petugas 2**: petugas2@perpustakaan.test / password

## Fitur Lengkap

### 1. Authentication & Authorization
- ✅ Login/Logout
- ✅ Role-based access (Admin & Petugas)
- ✅ Session management
- ✅ CSRF protection

### 2. Manajemen Buku
- ✅ CRUD buku lengkap
- ✅ Validasi stok minimal 2 untuk buku baru
- ✅ Search berdasarkan judul, penulis, ISBN, kategori
- ✅ Tracking stok otomatis
- ✅ Color-coded stock indicators
- ✅ Pagination

### 3. Manajemen Peminjaman
- ✅ Batas maksimal 4 buku aktif per user
- ✅ Validasi ketersediaan buku
- ✅ Perhitungan denda otomatis (Rp2.000/hari)
- ✅ Pengembalian dengan update stok otomatis
- ✅ Database transaction untuk data integrity
- ✅ Filter by status dan user
- ✅ Overdue tracking

### 4. Dashboard & Laporan
- ✅ Dashboard dengan statistik real-time
- ✅ Laporan peminjaman harian
- ✅ Laporan buku terlambat
- ✅ Tracking buku dengan stok rendah
- ✅ Recent activities
- ✅ Quick actions

### 5. UI/UX
- ✅ Responsive design (mobile, tablet, desktop)
- ✅ Professional color scheme
- ✅ Flash messages
- ✅ Loading states
- ✅ Form validation feedback
- ✅ Hover effects & transitions

## Struktur Database

### Tabel Users
```
- id (PK)
- name
- email (unique)
- password (hashed)
- role (enum: admin, petugas)
- remember_token
- timestamps
```

### Tabel Books
```
- id (PK)
- title
- author
- publisher (nullable)
- publication_year (nullable)
- isbn (unique, nullable)
- category (nullable)
- description (nullable)
- stock (default: 0)
- timestamps
```

### Tabel Loans
```
- id (PK)
- user_id (FK -> users.id)
- book_id (FK -> books.id)
- loan_date
- due_date
- return_date (nullable)
- fine_amount (decimal, default: 0)
- status (enum: active, returned)
- timestamps
```

## Business Rules

1. **Stok Buku Baru**: Minimal 2 (validasi di BookController)
2. **Batas Peminjaman**: Maksimal 4 buku aktif per user
3. **Denda**: Rp2.000 per hari keterlambatan
4. **Stok Management**: Otomatis berkurang saat pinjam, bertambah saat kembali
5. **Data Integrity**: Menggunakan database transactions
6. **Foreign Key Constraints**: Cascade delete untuk data consistency

## Fitur Keamanan

- ✅ CSRF Protection
- ✅ Password Hashing (bcrypt)
- ✅ Input Validation
- ✅ SQL Injection Prevention (Eloquent ORM)
- ✅ XSS Protection (Blade escaping)
- ✅ Session Security
- ✅ Mass Assignment Protection

## Testing

Untuk testing aplikasi:

1. Login sebagai Admin
2. Tambah buku baru (pastikan stok >= 2)
3. Buat peminjaman baru
4. Cek dashboard untuk statistik
5. Test pengembalian buku
6. Lihat laporan harian
7. Test validasi (coba tambah buku dengan stok < 2)
8. Test batas peminjaman (coba pinjam > 4 buku)

## Troubleshooting

### Database Error
Jika ada error database, pastikan:
- File database.sqlite sudah dibuat
- .env menggunakan DB_CONNECTION=sqlite
- Migration sudah dijalankan

### Permission Error
```bash
chmod -R 775 storage bootstrap/cache
```

### Composer Error
```bash
composer clear-cache
composer install
```

## Catatan Penting

- ✅ Aplikasi ini dirancang untuk MySQL tapi saat ini menggunakan SQLite untuk kemudahan development
- ✅ Semua migration sudah menggunakan InnoDB engine untuk kompatibilitas MySQL
- ✅ Foreign key constraints sudah diterapkan
- ✅ Validation rules sudah sesuai dengan requirements UAS
- ✅ Menggunakan Tailwind CSS & Alpine.js via CDN untuk kemudahan deployment
- ✅ Responsive dan mobile-friendly
- ✅ Clean code dengan separation of concerns

## Dokumentasi Tambahan

File-file penting:
- `README.md` - Dokumentasi project UAS
- `SETUP_GUIDE.md` - Panduan setup ini
- `setup.sh` - Script instalasi otomatis

## Kontak & Support

Jika ada pertanyaan atau issue, silakan hubungi developer atau buka issue di repository.

---

**Status**: ✅ READY FOR PRODUCTION
**Last Updated**: {{ date('Y-m-d') }}

