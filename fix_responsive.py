import os
import re

# Files to fix
files_to_fix = [
    'resources/views/loans/index.blade.php',
    'resources/views/books/index.blade.php',
    'resources/views/dashboard.blade.php',
    'resources/views/reports/daily.blade.php',
    'resources/views/reports/overdue.blade.php',
]

for file_path in files_to_fix:
    full_path = f'/home/bleu/perpustakaan-digital/{file_path}'
    
    if not os.path.exists(full_path):
        continue
    
    with open(full_path, 'r') as f:
        content = f.read()
    
    # Fix header section - make responsive
    content = re.sub(
        r'<div class="flex justify-between items-center mb-8">',
        '<div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6 sm:mb-8">',
        content
    )
    
    # Fix max-w-7xl container
    content = re.sub(
        r'<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">',
        '<div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">',
        content
    )
    
    # Fix heading text size - responsive
    content = re.sub(
        r'<h1 class="text-3xl font-bold',
        '<h1 class="text-2xl sm:text-3xl font-bold',
        content
    )
    
    # Fix buttons - make them full width on mobile
    content = re.sub(
        r'class="bg-sky-500 text-white px-6 py-3 rounded-lg font-bold hover:bg-sky-600 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 inline-flex items-center"',
        'class="w-full sm:w-auto bg-sky-500 text-white px-6 py-3 rounded-lg font-bold hover:bg-sky-600 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 inline-flex items-center justify-center"',
        content
    )
    
    with open(full_path, 'w') as f:
        f.write(content)
    
    print(f"Fixed: {file_path}")

print("All files fixed!")
