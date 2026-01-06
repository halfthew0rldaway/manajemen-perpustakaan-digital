import os
import re

print("�� Checking UI Consistency...\n")

# Standard patterns to check
patterns = {
    'Card Container': r'bg-white.*?rounded.*?shadow',
    'Table Container': r'overflow-x-auto',
    'Form Container': r'<form.*?class=',
    'Button Primary': r'bg-sky-500.*?text-white',
    'Button Secondary': r'bg-gray',
    'Input Field': r'<input.*?class=',
    'Select Field': r'<select.*?class=',
}

files_to_check = [
    'resources/views/books/index.blade.php',
    'resources/views/books/show.blade.php',
    'resources/views/loans/index.blade.php',
    'resources/views/loans/show.blade.php',
    'resources/views/reports/daily.blade.php',
    'resources/views/reports/overdue.blade.php',
]

issues = []

for file_path in files_to_check:
    full_path = f'/home/bleu/perpustakaan-digital/{file_path}'
    if not os.path.exists(full_path):
        continue
    
    with open(full_path, 'r') as f:
        content = f.read()
    
    # Check for inconsistent card styling
    if 'rounded-lg' in content and 'rounded-xl' in content:
        issues.append(f"❌ {file_path}: Mixed border radius (lg vs xl)")
    
    # Check for inconsistent shadow
    if 'shadow-sm' in content and 'shadow-md' in content and 'shadow-lg' in content:
        issues.append(f"⚠️  {file_path}: Multiple shadow sizes used")
    
    # Check for inconsistent spacing
    if 'gap-4' in content and 'gap-6' in content and 'gap-8' in content:
        issues.append(f"⚠️  {file_path}: Inconsistent gap spacing")
    
    # Check for old btn-* classes
    if 'btn-primary' in content or 'btn-secondary' in content:
        issues.append(f"❌ {file_path}: Using old btn-* classes")
    
    # Check for inline styles (should be minimal)
    inline_styles = re.findall(r'style="[^"]*"', content)
    if len(inline_styles) > 5:
        issues.append(f"⚠️  {file_path}: Many inline styles ({len(inline_styles)})")

if issues:
    print("Issues found:\n")
    for issue in issues:
        print(issue)
else:
    print("✅ No major consistency issues found!")

print("\n📊 Standardizing common elements...")

# Now fix common issues
for file_path in files_to_check:
    full_path = f'/home/bleu/perpustakaan-digital/{file_path}'
    if not os.path.exists(full_path):
        continue
    
    with open(full_path, 'r') as f:
        content = f.read()
    
    modified = False
    
    # Standardize card containers
    if 'rounded-lg' in content:
        content = re.sub(
            r'bg-white rounded-lg shadow-sm border border-gray-100',
            'bg-white sm:rounded-xl shadow-sm border-0 sm:border border-gray-100',
            content
        )
        modified = True
    
    # Standardize table wrappers
    content = re.sub(
        r'<div class="overflow-x-auto">',
        '<div class="overflow-x-auto -mx-4 sm:mx-0">',
        content
    )
    
    # Standardize input fields
    content = re.sub(
        r'class="w-full px-4 py-2 border border-gray-300 rounded-lg',
        'class="w-full px-4 py-2 sm:py-3 border-2 border-gray-300 rounded-lg',
        content
    )
    
    if modified:
        with open(full_path, 'w') as f:
            f.write(content)
        print(f"✅ Fixed {file_path}")

print("\n✅ Consistency check complete!")
