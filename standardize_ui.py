import os
import re

# Standard button class for primary action buttons
PRIMARY_BUTTON = 'w-full sm:w-auto bg-sky-500 text-white px-6 py-3 rounded-lg font-bold hover:bg-sky-600 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 inline-flex items-center justify-center'
PRIMARY_BUTTON_STYLE = 'border-bottom: 4px solid #0284c7;'

# Files to standardize
files = {
    'resources/views/books/index.blade.php': {
        'old_button': r'<a href="{{ route\(\'books\.create\'\) }}" class="btn-primary">',
        'new_button': f'<a href="{{{{ route(\'books.create\') }}}}" class="{PRIMARY_BUTTON}" style="{PRIMARY_BUTTON_STYLE}">',
        'header': 'flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6 sm:mb-8'
    },
    'resources/views/loans/index.blade.php': {
        # Already has inline classes, just verify consistency
    },
    'resources/views/dashboard.blade.php': {
        # Check for any buttons
    }
}

# Read and fix books/index.blade.php
books_index = '/home/bleu/perpustakaan-digital/resources/views/books/index.blade.php'
with open(books_index, 'r') as f:
    content = f.read()

# Fix header div
content = re.sub(
    r'<div class="flex items-center justify-between">',
    '<div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6 sm:mb-8">',
    content
)

# Fix button - replace btn-primary with inline classes
content = re.sub(
    r'<a href="{{ route\(\'books\.create\'\) }}" class="btn-primary">',
    f'<a href="{{{{ route(\'books.create\') }}}}" class="{PRIMARY_BUTTON}" style="{PRIMARY_BUTTON_STYLE}">',
    content
)

# Remove the extra span wrapper if exists
content = re.sub(
    r'<span class="flex items-center">\s*<svg',
    '<svg',
    content
)

content = re.sub(
    r'Tambah Buku\s*</span>',
    'Tambah Buku',
    content
)

with open(books_index, 'w') as f:
    f.write(content)

print("✅ Fixed books/index.blade.php")

# Now let's check and standardize all page headers
pages_to_check = [
    'resources/views/books/index.blade.php',
    'resources/views/loans/index.blade.php',
    'resources/views/reports/daily.blade.php',
    'resources/views/reports/overdue.blade.php',
]

for page in pages_to_check:
    full_path = f'/home/bleu/perpustakaan-digital/{page}'
    if not os.path.exists(full_path):
        continue
    
    with open(full_path, 'r') as f:
        content = f.read()
    
    # Ensure consistent heading sizes
    content = re.sub(
        r'<h1 class="text-3xl font-bold',
        '<h1 class="text-2xl sm:text-3xl font-bold',
        content
    )
    
    # Ensure consistent paragraph margins
    content = re.sub(
        r'<p class="mt-2 text-gray-600">',
        '<p class="mt-1 sm:mt-2 text-sm sm:text-base text-gray-600">',
        content
    )
    
    with open(full_path, 'w') as f:
        f.write(content)
    
    print(f"✅ Standardized {page}")

print("\n✅ All pages standardized!")
