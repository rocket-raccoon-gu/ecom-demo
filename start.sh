#!/bin/bash

# Create necessary directories
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs
mkdir -p bootstrap/cache

# Set permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Clear any existing caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Run migrations if database is available
php artisan migrate --force || echo "Migration failed, continuing..."

# Start the server
php artisan serve --host=0.0.0.0 --port=$PORT
