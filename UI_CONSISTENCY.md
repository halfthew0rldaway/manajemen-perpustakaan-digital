# UI Consistency & Standardization

## Overview

Semua halaman telah distandarisasi untuk memastikan konsistensi visual dan UX yang seragam di seluruh aplikasi.

## Issues Fixed

### 1. **Inconsistent Button Styles** ❌ → ✅

#### Before:
```html
<!-- books/index.blade.php -->
<a href="..." class="btn-primary">Tambah Buku</a>

<!-- loans/index.blade.php -->
<a href="..." class="bg-sky-500 text-white px-6 py-3 ...">Pinjam Buku</a>
```

#### After (Standardized):
```html
<!-- All pages now use same button class -->
<a href="..." 
   class="w-full sm:w-auto bg-sky-500 text-white px-6 py-3 rounded-lg font-bold hover:bg-sky-600 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 inline-flex items-center justify-center"
   style="border-bottom: 4px solid #0284c7;">
   <svg class="w-5 h-5 mr-2">...</svg>
   Button Text
</a>
```

---

### 2. **Mixed Border Radius** ❌ → ✅

#### Before:
```html
<!-- Some pages -->
<div class="rounded-lg">

<!-- Other pages -->
<div class="rounded-xl">
```

#### After (Standardized):
```html
<!-- All cards now use responsive border radius -->
<div class="sm:rounded-xl">
```

---

### 3. **Inconsistent Shadow Sizes** ❌ → ✅

#### Before:
```html
shadow-sm    <!-- Some elements -->
shadow-md    <!-- Other elements -->
shadow-lg    <!-- More elements -->
```

#### After (Standardized):
```html
shadow-sm    <!-- Cards, containers -->
shadow-lg    <!-- Buttons (primary) -->
shadow-md    <!-- Buttons (secondary) -->
```

---

### 4. **Inconsistent Spacing** ❌ → ✅

#### Before:
```html
gap-4    <!-- Some places -->
gap-6    <!-- Other places -->
gap-8    <!-- More places -->
```

#### After (Standardized):
```html
gap-3 sm:gap-4    <!-- Forms, filters -->
gap-4             <!-- General spacing -->
gap-6 sm:gap-8    <!-- Section spacing -->
```

---

### 5. **Inconsistent Headers** ❌ → ✅

#### Before:
```html
<!-- books/index.blade.php -->
<div class="flex items-center justify-between">

<!-- loans/index.blade.php -->
<div class="flex flex-col sm:flex-row sm:justify-between">
```

#### After (Standardized):
```html
<!-- All pages -->
<div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6 sm:mb-8">
```

---

## Standard Components

### Primary Action Button

```html
<a href="..." 
   class="w-full sm:w-auto bg-sky-500 text-white px-6 py-3 rounded-lg font-bold hover:bg-sky-600 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 inline-flex items-center justify-center"
   style="border-bottom: 4px solid #0284c7;">
   <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
   </svg>
   Button Text
</a>
```

**Usage:**
- Tambah Buku
- Pinjam Buku
- Primary actions

---

### Secondary Action Button

```html
<a href="..." 
   class="w-full sm:w-auto bg-gray-200 text-gray-700 px-6 py-2 rounded-lg font-bold hover:bg-gray-300 transition-all shadow-md hover:shadow-lg border-2 border-gray-300 hover:border-gray-400 transform hover:-translate-y-0.5 inline-flex items-center justify-center"
   style="border-bottom: 3px solid #9ca3af;">
   <svg class="w-4 h-4 mr-1.5">...</svg>
   Button Text
</a>
```

**Usage:**
- Reset filters
- Cancel actions
- Secondary actions

---

### Filter/Action Button

```html
<button type="submit"
   class="w-full sm:w-auto bg-gray-800 text-white px-6 py-2 rounded-lg font-bold hover:bg-gray-900 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
   style="border-bottom: 3px solid #1f2937;">
   <svg class="w-4 h-4 inline mr-1.5">...</svg>
   Filter
</button>
```

**Usage:**
- Filter button
- Search button
- Form submit

---

### Card Container

```html
<div class="bg-white sm:rounded-xl shadow-sm border-0 sm:border border-gray-100 overflow-hidden">
   <!-- Card content -->
</div>
```

**Features:**
- No border on mobile (edge-to-edge)
- Rounded corners on tablet+
- Consistent shadow
- Overflow hidden for nested elements

---

### Table Container

```html
<div class="overflow-x-auto -mx-4 sm:mx-0">
   <table class="min-w-full divide-y divide-gray-200">
      <!-- Table content -->
   </table>
</div>
```

**Features:**
- Full bleed on mobile
- Horizontal scroll
- Normal margins on tablet+

---

### Page Header

```html
<div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6 sm:mb-8">
   <div>
      <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Page Title</h1>
      <p class="mt-1 sm:mt-2 text-sm sm:text-base text-gray-600">Description</p>
   </div>
   <!-- Action button -->
</div>
```

**Features:**
- Vertical stack on mobile
- Horizontal on tablet+
- Responsive text sizes
- Consistent spacing

---

### Form Container

```html
<form method="GET" class="flex flex-col sm:flex-row sm:flex-wrap gap-3 sm:gap-4">
   <div class="flex-1 min-w-[200px]">
      <select class="w-full px-4 py-2 sm:py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-400">
         <!-- Options -->
      </select>
   </div>
   <!-- More fields -->
</form>
```

**Features:**
- Vertical stack on mobile
- Horizontal wrap on tablet+
- Flexible field widths
- Consistent padding

---

### Input Field

```html
<input type="text" 
   class="w-full px-4 py-2 sm:py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-400 focus:border-sky-400 transition-all"
   placeholder="...">
```

**Features:**
- Full width
- Responsive padding
- Focus states
- Smooth transitions

---

## Files Standardized

1. ✅ `resources/views/books/index.blade.php`
2. ✅ `resources/views/books/show.blade.php`
3. ✅ `resources/views/loans/index.blade.php`
4. ✅ `resources/views/loans/show.blade.php`
5. ✅ `resources/views/reports/daily.blade.php`
6. ✅ `resources/views/reports/overdue.blade.php`
7. ✅ `resources/views/dashboard.blade.php`

---

## Design System

### Colors

#### Primary (Sky Blue)
```css
bg-sky-500      /* Background */
text-sky-600    /* Text/Icons */
border-sky-400  /* Borders */
ring-sky-400    /* Focus rings */
```

#### Secondary (Gray)
```css
bg-gray-200     /* Background */
text-gray-700   /* Text */
border-gray-300 /* Borders */
```

#### Success (Teal)
```css
bg-teal-500     /* Background */
text-teal-600   /* Text */
```

#### Danger (Pink)
```css
bg-pink-500     /* Background */
text-pink-600   /* Text */
```

---

### Typography

#### Headings
```css
text-2xl sm:text-3xl font-bold    /* H1 */
text-xl sm:text-2xl font-semibold /* H2 */
text-lg font-semibold             /* H3 */
```

#### Body Text
```css
text-sm sm:text-base              /* Regular */
text-xs                           /* Small */
```

#### Labels
```css
text-sm font-medium               /* Form labels */
text-xs font-medium               /* Small labels */
```

---

### Spacing

#### Gaps
```css
gap-3 sm:gap-4    /* Forms, small spacing */
gap-4             /* General spacing */
gap-6 sm:gap-8    /* Section spacing */
```

#### Margins
```css
mb-6 sm:mb-8      /* Section bottom margin */
mt-1 sm:mt-2      /* Small top margin */
```

#### Padding
```css
px-4 sm:px-6 lg:px-8    /* Container horizontal */
py-3 sm:py-4            /* Container vertical */
p-4 sm:p-6              /* Card padding */
```

---

### Shadows

```css
shadow-sm         /* Cards, containers */
shadow-md         /* Secondary buttons */
shadow-lg         /* Primary buttons */
shadow-xl         /* Hover states */
```

---

### Border Radius

```css
rounded-lg        /* Buttons, inputs */
sm:rounded-xl     /* Cards (responsive) */
rounded-full      /* Avatars, badges */
```

---

## Consistency Checklist

### Buttons
- [x] All primary buttons use same classes
- [x] All secondary buttons use same classes
- [x] All buttons have 3D effect (border-bottom)
- [x] All buttons have hover states
- [x] All buttons are responsive (w-full sm:w-auto)
- [x] All buttons have icons (where appropriate)

### Cards
- [x] All cards use sm:rounded-xl
- [x] All cards use shadow-sm
- [x] All cards use border-0 sm:border
- [x] All cards have consistent padding

### Tables
- [x] All tables have overflow-x-auto wrapper
- [x] All tables use -mx-4 sm:mx-0
- [x] All tables have consistent styling
- [x] All table actions use same button styles

### Forms
- [x] All forms stack vertically on mobile
- [x] All inputs have consistent padding
- [x] All inputs have focus states
- [x] All forms have responsive gaps

### Headers
- [x] All page headers use same structure
- [x] All headings are responsive
- [x] All descriptions are responsive
- [x] All headers have consistent spacing

---

## Maintenance

### Adding New Pages

Use this template:

```html
@extends('layouts.app')

@section('content')
<div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
   <!-- Header -->
   <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6 sm:mb-8">
      <div>
         <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Page Title</h1>
         <p class="mt-1 sm:mt-2 text-sm sm:text-base text-gray-600">Description</p>
      </div>
      <!-- Primary action button here -->
   </div>

   <!-- Content cards/tables here -->
</div>
@endsection
```

---

## Benefits

1. **Consistency** - Same look & feel everywhere
2. **Maintainability** - Easy to update globally
3. **Responsive** - Works on all devices
4. **Professional** - Polished appearance
5. **Accessibility** - WCAG compliant
6. **Performance** - Optimized CSS

---

## Related Files

- `RESPONSIVE_FIXES.md` - Responsive design documentation
- `ANIMATIONS.md` - Animation documentation
- `BUTTON_ENHANCEMENTS.md` - Button styling guide
