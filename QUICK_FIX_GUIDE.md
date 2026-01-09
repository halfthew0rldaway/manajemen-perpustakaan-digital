# Quick Fix Script - Replace All Colorful Buttons and Badges

## Files yang Perlu Diupdate

Berikut adalah daftar file dan perubahan yang perlu dilakukan:

### 1. Books Index (`resources/views/books/index.blade.php`)
**Perubahan:**
- Line 195: `bg-teal-500` → `btn-primary` class
- Semua badge status stok: gunakan `badge` class
- Heading: tambahkan `class="heading"`

### 2. Books Show (`resources/views/books/show.blade.php`)
**Perubahan:**
- Line 82, 121: Badge warna-warni → `badge` class dengan conditional styling minimal
- Line 187: `bg-teal-500` → `btn-primary` class
- Heading: tambahkan `class="heading"`

### 3. Categories Index (`resources/views/categories/index.blade.php`)
**Perubahan:**
- Line 71: `bg-teal-500` → `btn-primary` class
- Heading: tambahkan `class="heading"`

### 4. Loans Index (`resources/views/loans/index.blade.php`)
**Perubahan:**
- Line 134: Badge `bg-teal-100 text-teal-700` → `badge` class
- Line 158: `bg-teal-500` → `btn-primary` class
- Heading: tambahkan `class="heading"`

### 5. Loans Show (`resources/views/loans/show.blade.php`)
**Perubahan:**
- Line 79, 110: Badge `bg-teal` → `badge` class
- Line 132: `bg-teal-500` → `btn-primary` class
- Heading: tambahkan `class="heading"`

### 6. Loans Create (`resources/views/loans/create.blade.php`)
**Perubahan:**
- Line 116: `bg-teal-500` → `btn-primary` class
- Heading: tambahkan `class="heading"`

### 7. Reports Daily (`resources/views/reports/daily.blade.php`)
**Perubahan:**
- Line 146: Badge `bg-teal-100` → `badge` class
- Heading: tambahkan `class="heading"`
- Export button: gunakan `btn-primary`

### 8. Reports Overdue (`resources/views/reports/overdue.blade.php`)
**Perubahan:**
- Line 181: `bg-teal-500` → `btn-primary` class
- Heading: tambahkan `class="heading"`
- Export button: gunakan `btn-primary`

## Pattern Replacement Guide

### Tombol Edit/Tambah/Simpan (SEMUA HARUS ACCENT COLOR)
```html
<!-- BEFORE -->
<button class="bg-teal-500 text-white rounded-lg hover:bg-teal-600">Edit</button>
<button class="bg-green-500 text-white rounded-lg hover:bg-green-600">Tambah</button>

<!-- AFTER -->
<button class="btn-primary">Edit</button>
<button class="btn-primary">Tambah</button>
```

### Tombol Hapus (HANYA INI YANG DESTRUCTIVE)
```html
<!-- BEFORE -->
<button class="bg-pink-500 text-white rounded-lg hover:bg-pink-600">Hapus</button>
<button class="bg-red-500 text-white rounded-lg hover:bg-red-600">Delete</button>

<!-- AFTER -->
<button class="btn-danger">Hapus</button>
```

### Tombol Kembali/Batal
```html
<!-- BEFORE -->
<a href="..." class="bg-gray-200 text-gray-700">Kembali</a>

<!-- AFTER -->
<a href="..." class="btn-secondary">Kembali</a>
```

### Badge Status (HARUS MUTED)
```html
<!-- BEFORE -->
<span class="bg-teal-100 text-teal-700 px-2 py-1 rounded">Aktif</span>
<span class="bg-green-100 text-green-700 px-2 py-1 rounded">Tersedia</span>

<!-- AFTER -->
<span class="badge">Aktif</span>
<span class="badge">Tersedia</span>
```

### Heading (HARUS SOURCE SERIF 4)
```html
<!-- BEFORE -->
<h1 class="text-2xl font-bold">Daftar Buku</h1>
<h2 class="text-lg font-bold">Detail</h2>

<!-- AFTER -->
<h1 class="heading" style="font-size: 2rem;">Daftar Buku</h1>
<h2 class="heading" style="font-size: 1.125rem;">Detail</h2>
```

### Card
```html
<!-- BEFORE -->
<div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg border">

<!-- AFTER -->
<div class="card">
```

## Automated Replacement Commands

Untuk mempercepat, gunakan find & replace di editor dengan pattern berikut:

1. **Replace teal buttons:**
   - Find: `bg-teal-500 text-white.*?hover:bg-teal-600`
   - Replace: Evaluate context, use `btn-primary` if Edit/Add/Save

2. **Replace green buttons:**
   - Find: `bg-green-500`
   - Replace: Use `btn-primary`

3. **Replace pink/red delete buttons:**
   - Find: `bg-pink-500.*?hover:bg-pink-600`
   - Replace: `btn-danger`

4. **Replace badges:**
   - Find: `bg-teal-100 text-teal-700`
   - Replace: `badge`

5. **Replace card classes:**
   - Find: `bg-white dark:bg-slate-800 rounded-lg shadow-lg border`
   - Replace: `card`

## Priority Order

1. ✅ Dashboard - DONE
2. ⏳ Books pages (index, show, create, edit)
3. ⏳ Categories pages (index, create, edit)
4. ⏳ Loans pages (index, show, create, edit)
5. ⏳ Reports pages (daily, overdue)
6. ⏳ Login page

## Testing Checklist

Setelah semua perubahan:
- [ ] Tidak ada tombol hijau/teal/purple/orange untuk Edit
- [ ] Semua tombol Edit/Tambah/Simpan menggunakan accent color
- [ ] Hanya tombol Hapus yang menggunakan destructive color
- [ ] Semua badge menggunakan warna muted
- [ ] Semua heading menggunakan Source Serif 4
- [ ] Semua body text menggunakan Inter
- [ ] Test di bright mode
- [ ] Test di dark mode
