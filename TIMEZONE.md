# Indonesian Timezone Support

## Overview

Aplikasi Perpustakaan Digital sekarang mendukung timezone Indonesia (WIB, WITA, WIT) untuk menampilkan waktu yang akurat sesuai zona waktu Indonesia.

## Configuration

### Default Timezone
```php
// config/app.php
'timezone' => env('APP_TIMEZONE', 'Asia/Jakarta'),
```

Default timezone diset ke **Asia/Jakarta (WIB)**.

### Available Timezones

| Timezone | Abbreviation | GMT Offset | Coverage |
|----------|--------------|------------|----------|
| Asia/Jakarta | WIB | GMT+7 | Jawa, Sumatra |
| Asia/Makassar | WITA | GMT+8 | Kalimantan, Sulawesi, Bali, NTB, NTT |
| Asia/Jayapura | WIT | GMT+9 | Papua, Maluku |

## Helper Functions

### 1. `indonesian_timezone()`
Get Indonesian timezone abbreviation (WIB/WITA/WIT).

```php
// Get current timezone abbreviation
$tz = indonesian_timezone();
// Returns: 'WIB' (if timezone is Asia/Jakarta)

// Get specific timezone abbreviation
$tz = indonesian_timezone('Asia/Makassar');
// Returns: 'WITA'
```

### 2. `format_datetime_indonesia()`
Format datetime with Indonesian timezone.

```php
// Format current datetime
$formatted = format_datetime_indonesia(now());
// Returns: "06 Jan 2026 11:18 WIB"

// Format specific datetime
$formatted = format_datetime_indonesia($loan->loan_date);
// Returns: "05 Jan 2026 14:30 WIB"

// Custom format
$formatted = format_datetime_indonesia(now(), 'd/m/Y H:i:s');
// Returns: "06/01/2026 11:18:45 WIB"
```

### 3. `now_indonesia()`
Get current datetime in Indonesian timezone.

```php
$now = now_indonesia();
// Returns: Carbon instance with Asia/Jakarta timezone
```

### 4. `timezone_options()`
Get timezone options for select dropdown.

```php
$timezones = timezone_options();
// Returns:
// [
//     'Asia/Jakarta' => 'WIB (Waktu Indonesia Barat)',
//     'Asia/Makassar' => 'WITA (Waktu Indonesia Tengah)',
//     'Asia/Jayapura' => 'WIT (Waktu Indonesia Timur)',
// ]
```

## Usage Examples

### In Blade Templates

#### Display Current Time
```blade
<p>Waktu sekarang: {{ format_datetime_indonesia(now()) }}</p>
<!-- Output: Waktu sekarang: 06 Jan 2026 11:18 WIB -->
```

#### Display Loan Date
```blade
<td>{{ format_datetime_indonesia($loan->loan_date, 'd M Y') }}</td>
<!-- Output: 05 Jan 2026 WIB -->
```

#### Display Due Date
```blade
<p>Jatuh tempo: {{ format_datetime_indonesia($loan->due_date, 'd F Y H:i') }}</p>
<!-- Output: Jatuh tempo: 15 Januari 2026 23:59 WIB -->
```

### In Controllers

#### Create Loan with Current Time
```php
$loan = Loan::create([
    'user_id' => $userId,
    'book_id' => $bookId,
    'loan_date' => now_indonesia(),
    'due_date' => now_indonesia()->addDays(7),
]);
```

#### Check Overdue
```php
public function isOverdue()
{
    return now_indonesia()->greaterThan($this->due_date);
}
```

### Timezone Selector

#### In Forms
```blade
<select name="timezone" class="form-select">
    @foreach(timezone_options() as $value => $label)
        <option value="{{ $value }}" {{ config('app.timezone') == $value ? 'selected' : '' }}>
            {{ $label }}
        </option>
    @endforeach
</select>
```

## Date Format Examples

### Common Formats

```php
// Short date
format_datetime_indonesia($date, 'd/m/Y')
// Output: 06/01/2026 WIB

// Long date
format_datetime_indonesia($date, 'd F Y')
// Output: 06 Januari 2026 WIB

// Date with time
format_datetime_indonesia($date, 'd M Y H:i')
// Output: 06 Jan 2026 11:18 WIB

// Full datetime
format_datetime_indonesia($date, 'd F Y H:i:s')
// Output: 06 Januari 2026 11:18:45 WIB

// Time only
format_datetime_indonesia($date, 'H:i')
// Output: 11:18 WIB
```

## Carbon Integration

All helper functions work seamlessly with Carbon:

```php
use Carbon\Carbon;

// Create date in Indonesian timezone
$date = Carbon::now('Asia/Jakarta');

// Format with helper
$formatted = format_datetime_indonesia($date);

// Parse string to Carbon
$date = Carbon::parse('2026-01-06 11:18:00', 'Asia/Jakarta');
```

## Environment Variables

You can override the timezone in `.env`:

```env
APP_TIMEZONE=Asia/Jakarta  # WIB (default)
# or
APP_TIMEZONE=Asia/Makassar # WITA
# or
APP_TIMEZONE=Asia/Jayapura # WIT
```

## Database Considerations

### Storing Dates

Laravel automatically converts dates to UTC when storing in database and converts back to app timezone when retrieving.

```php
// Model
protected $casts = [
    'loan_date' => 'datetime',
    'due_date' => 'datetime',
    'return_date' => 'datetime',
];

// When saving
$loan->loan_date = now_indonesia(); // Stored as UTC in DB

// When retrieving
$loan->loan_date; // Automatically converted to Asia/Jakarta
```

### Migrations

Dates in database are stored as UTC:

```php
$table->timestamp('loan_date');
$table->timestamp('due_date');
```

## Testing

### Test with Different Timezones

```php
// Test WIB
config(['app.timezone' => 'Asia/Jakarta']);
$this->assertEquals('WIB', indonesian_timezone());

// Test WITA
config(['app.timezone' => 'Asia/Makassar']);
$this->assertEquals('WITA', indonesian_timezone());

// Test WIT
config(['app.timezone' => 'Asia/Jayapura']);
$this->assertEquals('WIT', indonesian_timezone());
```

## Migration Guide

### Update Existing Views

Replace:
```blade
<!-- Before -->
{{ $loan->loan_date->format('d M Y H:i') }}

<!-- After -->
{{ format_datetime_indonesia($loan->loan_date) }}
```

### Update Controllers

Replace:
```php
// Before
$loan->loan_date = now();

// After
$loan->loan_date = now_indonesia();
```

## Troubleshooting

### Timezone Not Updating

1. Clear config cache:
```bash
php artisan config:clear
```

2. Reload autoload files:
```bash
composer dump-autoload
```

3. Restart server:
```bash
php artisan serve
```

### Wrong Timezone Displayed

Check:
1. `config/app.php` - timezone setting
2. `.env` - APP_TIMEZONE value
3. Database - dates stored as UTC
4. Model - $casts array includes datetime fields

## Best Practices

1. **Always use helper functions** for displaying dates to users
2. **Store dates as UTC** in database (Laravel default)
3. **Use now_indonesia()** instead of `now()` for Indonesian time
4. **Format consistently** across the application
5. **Test with different timezones** if app will be used across Indonesia

## Performance

- ✅ Helper functions are cached by PHP
- ✅ No database queries
- ✅ Minimal overhead
- ✅ Carbon is already optimized

## Browser Support

Timezone display works in all browsers as it's server-side rendering.

## Future Enhancements

Potential additions:
1. User-specific timezone preferences
2. Automatic timezone detection based on IP
3. Timezone conversion tools
4. Multi-timezone support for distributed teams

## Related Files

- `config/app.php` - Timezone configuration
- `app/Helpers/TimezoneHelper.php` - Helper functions
- `composer.json` - Autoload configuration
