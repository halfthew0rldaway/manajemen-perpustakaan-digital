import os
import re

# Files with tables
files_to_fix = [
    'resources/views/loans/index.blade.php',
    'resources/views/books/index.blade.php',
    'resources/views/reports/daily.blade.php',
    'resources/views/reports/overdue.blade.php',
]

for file_path in files_to_fix:
    full_path = f'/home/bleu/perpustakaan-digital/{file_path}'
    
    if not os.path.exists(full_path):
        continue
    
    with open(full_path, 'r') as f:
        content = f.read()
    
    # Fix table container - add responsive wrapper
    content = re.sub(
        r'<div class="overflow-x-auto">',
        '<div class="overflow-x-auto -mx-4 sm:mx-0">',
        content
    )
    
    # Fix card/table wrapper
    content = re.sub(
        r'<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">',
        '<div class="bg-white sm:rounded-xl shadow-sm border-0 sm:border border-gray-100 overflow-hidden">',
        content
    )
    
    # Fix filter form - make responsive
    content = re.sub(
        r'<form method="GET"([^>]*?)class="flex flex-wrap gap-4"',
        r'<form method="GET"\1class="flex flex-col sm:flex-row sm:flex-wrap gap-3 sm:gap-4"',
        content
    )
    
    with open(full_path, 'w') as f:
        f.write(content)
    
    print(f"Fixed tables in: {file_path}")

print("All tables fixed!")
