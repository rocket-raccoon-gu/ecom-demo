#!/bin/bash

echo "🚀 Starting DemoShop Deployment..."

# Build assets
echo "📦 Building assets..."
npm run build

# Install composer dependencies
echo "🔧 Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader

# Run deployment scripts
echo "⚙️ Running deployment scripts..."
composer run deploy

# Set permissions
echo "🔐 Setting permissions..."
chmod -R 775 storage bootstrap/cache

echo "✅ Deployment preparation complete!"
echo "🌐 Your app is ready to deploy to Railway or Render!"
echo ""
echo "Next steps:"
echo "1. Push to GitHub"
echo "2. Connect to Railway/Render"
echo "3. Set environment variables"
echo "4. Deploy!"
