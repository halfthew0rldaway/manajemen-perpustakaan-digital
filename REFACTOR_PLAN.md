# UI Refactoring Plan - Perpustakaan Digital

## Objective
Transform the digital library management system from a vibrant, developer-centric UI into a calm, professional academic institution product with focus on long-term readability and visual consistency.

## Design Principles
1. **Academic & Professional**: Calm, stable, institutional feel
2. **Typography-First**: Source Serif 4 for headings, Inter for body
3. **Muted Colors**: Single accent color system, no vibrant gradients
4. **Minimal Shadows**: Flat or very subtle shadows
5. **Consistent Hierarchy**: Clear information structure throughout

## Color System

### Dark Mode
- **Backgrounds**: 
  - Primary: `#0E141B`
  - Card: `#161D26`
  - Sidebar: `#0B1117`
- **Borders**: `#243041`
- **Text**:
  - Primary: `#E6EBF0`
  - Secondary: `#A9B4C2`
  - Muted: `#7C8796`
- **Accent**: `#4FA3A5` (hover: `#6BBBBC`)
- **Destructive**: `#C25C5C` (hover: `#D87474`)
- **Badge**: bg `#1E2B33`, text `#8FD0D1`

### Bright Mode
- **Backgrounds**:
  - Primary: `#F3F5F7`
  - Card: `#FFFFFF`
  - Sidebar: `#EEF1F4`
- **Borders**: `#D9DEE5`
- **Text**:
  - Primary: `#1F2933`
  - Secondary: `#4B5563`
  - Muted: `#6B7280`
- **Accent**: `#3B8E91` (hover: `#317A7D`)
- **Destructive**: `#B24A4A` (hover: `#C85E5E`)
- **Badge**: bg `#E6F2F2`, text `#2F6F73`

## Typography
- **Headings**: Source Serif 4 (h1-h6, card titles, section titles)
- **Body**: Inter (paragraphs, tables, forms, buttons, badges)
- **Size Scale**: Moderate heading sizes, slightly larger body text for readability

## UI Rules
1. **Single Accent Color**: All primary actions (Add, Edit, Save) use accent color
2. **No Color Variety**: Remove green, purple, amber, pink from action buttons
3. **Destructive Only**: Red/destructive color only for Delete and dangerous actions
4. **Muted Badges**: Information badges should be subtle, not eye-catching
5. **Subtle Active States**: Sidebar active items use 10-12% opacity accent background
6. **No Heavy Gradients**: Replace with solid colors
7. **Minimal Shadows**: Very subtle or flat design
8. **Proper Contrast**: Sufficient but not glaring

## Files to Update
1. `/resources/views/layouts/app.blade.php` - Main layout, CSS variables, typography
2. `/resources/views/dashboard.blade.php` - Dashboard cards and stats
3. `/resources/views/books/index.blade.php` - Books listing
4. `/resources/views/books/create.blade.php` - Book creation form
5. `/resources/views/books/edit.blade.php` - Book edit form
6. `/resources/views/categories/index.blade.php` - Categories listing
7. `/resources/views/categories/create.blade.php` - Category creation
8. `/resources/views/categories/edit.blade.php` - Category edit
9. `/resources/views/loans/index.blade.php` - Loans listing
10. `/resources/views/loans/create.blade.php` - Loan creation
11. `/resources/views/loans/edit.blade.php` - Loan edit
12. `/resources/views/auth/login.blade.php` - Login page
13. `/resources/views/reports/*.blade.php` - Report pages

## Implementation Steps
1. Update main layout with CSS variables and new typography
2. Refactor button styles (single accent + destructive only)
3. Update form elements styling
4. Refactor card components
5. Update sidebar styling and active states
6. Refactor dashboard statistics cards
7. Update table styling
8. Refactor badges and status indicators
9. Update modal and notification styles
10. Test consistency across all pages in both modes
