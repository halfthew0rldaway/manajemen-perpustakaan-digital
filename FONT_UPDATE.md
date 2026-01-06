# Font Update - Outfit Typography

## Perubahan Font

Aplikasi Perpustakaan Digital telah diupdate dari **Poppins** ke **Outfit** untuk tampilan yang lebih modern dan stylish.

## Tentang Outfit

**Outfit** adalah modern geometric sans-serif font yang:
- ✅ Contemporary dan stylish
- ✅ Clean geometric forms
- ✅ Excellent readability untuk UI dan body text
- ✅ Versatile dengan berbagai weight options (300-800)
- ✅ Optimized untuk digital screens
- ✅ Cocok untuk aplikasi modern

## Kenapa Outfit?

### Keunggulan untuk Perpustakaan Digital:

1. **Modern & Professional**
   - Memberikan kesan contemporary tanpa kehilangan profesionalisme
   - Cocok untuk educational/library context

2. **Excellent Readability**
   - Geometric forms yang clean memudahkan reading
   - Spacing yang optimal untuk long-form text
   - Clear distinction antar karakter

3. **Versatile**
   - Bagus untuk headings (bold weights)
   - Bagus untuk body text (regular weights)
   - Bagus untuk UI elements (medium weights)

4. **Cocok dengan Soft/Pastel Theme**
   - Slightly more playful dari Inter
   - Warm appearance yang cocok dengan soft colors
   - Modern tapi tidak terlalu corporate

## Font Weights yang Digunakan

```css
font-family: 'Outfit', sans-serif;
```

**Available weights:**
- 300 (Light) - untuk subtle text
- 400 (Regular) - body text default
- 500 (Medium) - labels, secondary headings
- 600 (Semibold) - emphasized text
- 700 (Bold) - headings, buttons
- 800 (Extrabold) - hero text, major headings

## Files Updated

✅ **layouts/app.blade.php**
- Main application layout
- Affects all authenticated pages

✅ **auth/login.blade.php**
- Login page

✅ **errors/419.blade.php**
- Error page

## Implementation

### Google Fonts Import:
```html
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet">
```

### CSS:
```css
body {
    font-family: 'Outfit', sans-serif;
}
```

## Typography Hierarchy

### Headings
- **H1**: font-bold (700), text-3xl
- **H2**: font-semibold (600), text-2xl  
- **H3**: font-semibold (600), text-xl
- **H4**: font-medium (500), text-lg

### Body Text
- **Default**: font-normal (400), text-base
- **Small**: font-normal (400), text-sm
- **Extra Small**: font-normal (400), text-xs

### UI Elements
- **Buttons**: font-bold (700)
- **Labels**: font-semibold (600) atau font-medium (500)
- **Table Headers**: font-medium (500)
- **Links**: font-semibold (600)

## Comparison: Poppins vs Outfit

| Aspect | Poppins | Outfit |
|--------|---------|--------|
| Style | Geometric sans-serif | Geometric sans-serif |
| Character | Friendly, rounded | Modern, clean |
| Best for | General purpose | UI-focused apps |
| Readability | Excellent | Excellent |
| Modern feel | ⭐⭐⭐⭐ | ⭐⭐⭐⭐⭐ |
| Professional | ⭐⭐⭐⭐ | ⭐⭐⭐⭐⭐ |

## Performance

- **Font Loading**: Optimized dengan `font-display: swap`
- **Preconnect**: DNS prefetch untuk faster loading
- **Weights**: Hanya load weights yang digunakan (300-800)
- **Impact**: Minimal, Google Fonts sudah di-cache oleh browser

## Browser Support

✅ Chrome/Edge (Chromium)
✅ Firefox
✅ Safari
✅ Mobile browsers
✅ All modern browsers

## Accessibility

✅ **WCAG Compliant**
- Clear letterforms
- Good x-height untuk readability
- Distinct character shapes
- Optimal spacing

## Future Considerations

Jika ingin experiment dengan font lain:

### Alternative Options:
1. **Inter** - Lebih technical/professional
2. **Plus Jakarta Sans** - More friendly, Indonesian-made
3. **Manrope** - Similar geometric style
4. **DM Sans** - Cleaner, more minimal

### How to Change:
1. Update Google Fonts import URL
2. Update `font-family` in CSS
3. Test readability di semua pages
4. Verify button/heading hierarchy

## Notes

- Font change affects **entire application**
- All pages automatically updated
- No JavaScript changes needed
- Purely CSS/HTML update
- Backward compatible dengan existing styles

## Rollback

Jika ingin kembali ke Poppins:

```html
<!-- Change import -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet">

<!-- Change CSS -->
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
</style>
```

Apply ke 3 files:
- layouts/app.blade.php
- auth/login.blade.php  
- errors/419.blade.php
