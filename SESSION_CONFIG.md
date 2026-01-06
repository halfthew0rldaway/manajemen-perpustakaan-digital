# Konfigurasi Session - Mengatasi Page Expired

## Masalah
Error "419 | Page Expired" terjadi ketika:
- CSRF token kadaluarsa
- Session timeout (default 120 menit)
- User tidak aktif terlalu lama

## Solusi yang Telah Diterapkan

### 1. Custom Error Page (419.blade.php)
✅ Dibuat halaman error khusus dengan desain soft/pastel yang matching
- Memberikan pesan yang jelas kepada user
- Tombol "Refresh Halaman" untuk retry
- Auto-redirect setelah 5 detik
- Tips untuk mencegah error di masa depan

### 2. Auto-Refresh CSRF Token
✅ Script otomatis di `layouts/app.blade.php`
- Refresh CSRF token setiap 60 menit
- Mencegah token expired saat user sedang bekerja
- Berjalan di background tanpa mengganggu user

### 3. Konfigurasi Session (Opsional)

Jika ingin memperpanjang session lifetime, edit file `.env`:

```env
# Session Configuration
SESSION_LIFETIME=480          # 8 jam (default: 120 menit)
SESSION_EXPIRE_ON_CLOSE=false # Session tetap aktif meski browser ditutup
```

Atau edit langsung di `config/session.php`:

```php
'lifetime' => (int) env('SESSION_LIFETIME', 480), // 8 jam
```

## Rekomendasi

### Untuk Development:
```env
SESSION_LIFETIME=480  # 8 jam - lebih nyaman untuk development
```

### Untuk Production:
```env
SESSION_LIFETIME=120  # 2 jam - lebih aman
```

## Tips untuk User

1. **Centang "Ingat saya"** saat login untuk session lebih lama
2. **Simpan pekerjaan** secara berkala
3. **Jangan biarkan halaman idle** terlalu lama saat mengisi form
4. **Jika muncul error 419**, cukup klik "Refresh Halaman"

## Testing

Untuk test apakah solusi bekerja:

1. Login ke aplikasi
2. Biarkan idle selama 60+ menit
3. Coba submit form
4. Jika muncul error 419, akan muncul halaman custom yang user-friendly
5. CSRF token akan auto-refresh setiap 60 menit

## Monitoring

Buka browser console untuk melihat log:
```
CSRF token refreshed
```

Pesan ini akan muncul setiap 60 menit jika auto-refresh berjalan dengan baik.
