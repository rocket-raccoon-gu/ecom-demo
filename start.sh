#!/bin/bash

# Exit on any error
set -e

echo "🚀 Starting DemoShop deployment..."

# Create necessary directories
echo "📁 Creating directories..."
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs
mkdir -p bootstrap/cache

# Set permissions
echo "🔐 Setting permissions..."
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Clear any existing caches
echo "🧹 Clearing caches..."
php artisan config:clear || echo "Config clear failed, continuing..."
php artisan cache:clear || echo "Cache clear failed, continuing..."
php artisan view:clear || echo "View clear failed, continuing..."

# Generate application key if not exists
echo "🔑 Generating application key..."
php artisan key:generate --force || echo "Key generation failed, continuing..."

# Run migrations if database is available
echo "🗄️ Running migrations..."
php artisan migrate --force || echo "Migration failed, continuing..."

echo "✅ Setup complete! Starting server..."
echo "🌐 Server will be available at: http://0.0.0.0:$PORT"

# Start the server
exec php artisan serve --host=0.0.0.0 --port=$PORT
