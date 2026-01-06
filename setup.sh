#!/bin/bash

echo "🚀 Setting up Perpustakaan Digital..."

# Check if .env exists
if [ ! -f .env ]; then
    echo "📝 Creating .env file..."
    cp .env.example .env
fi

# Install Composer dependencies
echo "📦 Installing Composer dependencies..."
composer install

# Install NPM dependencies
echo "📦 Installing NPM dependencies..."
npm install

# Generate application key
echo "🔑 Generating application key..."
php artisan key:generate

# Create SQLite database if it doesn't exist
if [ ! -f database/database.sqlite ]; then
    echo "💾 Creating SQLite database..."
    touch database/database.sqlite
fi

# Run migrations and seeders
echo "🗄️  Running migrations and seeders..."
php artisan migrate:fresh --seed

# Build assets
echo "🎨 Building assets..."
npm run build

echo "✅ Setup complete!"
echo ""
echo "To start the development server, run:"
echo "  php artisan serve"
echo ""
echo "Default login credentials:"
echo "  Admin: admin@perpustakaan.test / password"
echo "  Petugas: petugas1@perpustakaan.test / password"
