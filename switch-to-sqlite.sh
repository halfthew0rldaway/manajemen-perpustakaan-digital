#!/bin/bash

echo "🔄 Switching to SQLite database..."

# Backup .env
cp .env .env.backup

# Update .env to use SQLite
sed -i 's/DB_CONNECTION=mysql/DB_CONNECTION=sqlite/' .env
sed -i 's/^DB_HOST=/#DB_HOST=/' .env
sed -i 's/^DB_PORT=/#DB_PORT=/' .env
sed -i 's/^DB_DATABASE=/#DB_DATABASE=/' .env
sed -i 's/^DB_USERNAME=/#DB_USERNAME=/' .env
sed -i 's/^DB_PASSWORD=/#DB_PASSWORD=/' .env

# Create SQLite database if not exists
if [ ! -f database/database.sqlite ]; then
    echo "📝 Creating SQLite database..."
    touch database/database.sqlite
fi

echo "✅ Database configuration updated to SQLite"
echo ""
echo "Now run:"
echo "  php artisan migrate:fresh --seed"
