#!/bin/bash

# UI Refactoring - Bulk Color Replacement Script
# This script replaces old colorful buttons and badges with new design system classes

echo "🎨 Starting UI Refactoring - Color Replacement..."

# Define the views directory
VIEWS_DIR="/home/bleu/perpustakaan-digital/resources/views"

# Function to replace in file
replace_in_file() {
    local file=$1
    local search=$2
    local replace=$3
    
    if [ -f "$file" ]; then
        sed -i "s/$search/$replace/g" "$file"
    fi
}

# 1. Replace teal/green Edit buttons with btn-primary
echo "📝 Replacing Edit/Add/Save buttons..."
find "$VIEWS_DIR" -name "*.blade.php" -type f -exec sed -i \
    's/bg-teal-500 text-white rounded-md font-medium hover:bg-teal-600 transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5/btn-primary/g' {} \;

find "$VIEWS_DIR" -name "*.blade.php" -type f -exec sed -i \
    's/bg-teal-500 text-white rounded-lg font-semibold hover:bg-teal-600 transition-all shadow-lg hover:shadow-xl/btn-primary/g' {} \;

find "$VIEWS_DIR" -name "*.blade.php" -type f -exec sed -i \
    's/bg-teal-500 text-white text-sm font-bold rounded-lg hover:bg-teal-600 transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5/btn-primary btn-sm/g' {} \;

# 2. Replace status badges
echo "🏷️  Replacing status badges..."
find "$VIEWS_DIR" -name "*.blade.php" -type f -exec sed -i \
    's/bg-teal-100 text-teal-700 dark:bg-teal-900\/50 dark:text-teal-300/badge/g' {} \;

find "$VIEWS_DIR" -name "*.blade.php" -type f -exec sed -i \
    's/bg-teal-100 text-teal-700/badge/g' {} \;

# 3. Replace pink delete buttons with btn-danger
echo "🗑️  Replacing Delete buttons..."
find "$VIEWS_DIR" -name "*.blade.php" -type f -exec sed -i \
    's/bg-pink-500 text-white.*hover:bg-pink-600/btn-danger/g' {} \;

# 4. Replace card classes
echo "🃏 Replacing card classes..."
find "$VIEWS_DIR" -name "*.blade.php" -type f -exec sed -i \
    's/bg-white dark:bg-slate-800 rounded-lg shadow-md border-2 border-gray-100 dark:border-gray-700/card/g' {} \;

echo "✅ Bulk replacement complete!"
echo ""
echo "⚠️  Manual review needed for:"
echo "  - Headings (add class='heading' and Source Serif 4)"
echo "  - Complex conditional badges"
echo "  - Form buttons context"
echo ""
echo "📋 Next steps:"
echo "  1. Review changes with: git diff"
echo "  2. Test in browser (bright & dark mode)"
echo "  3. Check QUICK_FIX_GUIDE.md for manual fixes"
