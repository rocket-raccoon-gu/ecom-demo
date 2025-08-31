# 🚀 Free Hosting Deployment Guide for DemoShop

## 📋 **Prerequisites**
- Git repository set up
- Laravel project ready
- Database credentials ready

## 🎯 **Recommended Free Hosting: Railway**

### **Why Railway?**
- ✅ Perfect Laravel support
- ✅ Easy deployment from GitHub
- ✅ Auto-scaling
- ✅ $5 free credit monthly
- ✅ Professional hosting quality

## 🛠️ **Step 1: Prepare Your Project**

### **1.1 Generate Application Key**
```bash
php artisan key:generate
```

### **1.2 Create Production .env File**
Create `.env` file with these settings:
```env
APP_NAME="DemoShop"
APP_ENV=production
APP_KEY=YOUR_GENERATED_KEY_HERE
APP_DEBUG=false
APP_URL=https://your-app-name.railway.app

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=${DB_HOST}
DB_PORT=${DB_PORT}
DB_DATABASE=${DB_DATABASE}
DB_USERNAME=${DB_USERNAME}
DB_PASSWORD=${DB_PASSWORD}

CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### **1.3 Update .gitignore**
Make sure `.gitignore` includes:
```gitignore
/node_modules
/public/hot
/public/storage
/storage/*.key
/vendor
.env
.env.backup
.phpunit.result.cache
docker-compose.override.yml
Homestead.json
Homestead.yaml
npm-debug.log
yarn-error.log
/.idea
/.vscode
```

### **1.4 Build Assets**
```bash
npm run build
```

## 🚀 **Step 2: Deploy to Railway**

### **2.1 Create Railway Account**
1. Go to [railway.app](https://railway.app)
2. Sign up with GitHub
3. Create new project

### **2.2 Connect GitHub Repository**
1. Choose "Deploy from GitHub repo"
2. Select your repository
3. Railway will auto-detect Laravel

### **2.3 Configure Environment Variables**
In Railway dashboard, add these variables:
```
APP_KEY=YOUR_GENERATED_KEY
APP_ENV=production
APP_DEBUG=false
```

### **2.4 Add Database**
1. Click "New" → "Database" → "MySQL"
2. Railway will auto-inject DB variables
3. Copy database connection details

### **2.5 Deploy**
1. Railway will auto-deploy on git push
2. Wait for build to complete
3. Your app will be live!

## 🌐 **Alternative: Render (Free Tier)**

### **Why Render?**
- ✅ 750 free hours/month
- ✅ Easy deployment
- ✅ Custom domains
- ❌ Sleeps after 15 min inactivity

### **Deployment Steps:**
1. Go to [render.com](https://render.com)
2. Connect GitHub repository
3. Choose "Web Service"
4. Set build command: `./build.sh`
5. Set start command: `php artisan serve --host 0.0.0.0 --port $PORT`

## 📁 **Required Files for Deployment**

### **1. Create build.sh**
```bash
#!/usr/bin/env bash
# exit on error
set -o errexit

bundle install
bundle exec rake assets:precompile
bundle exec rake assets:clean
bundle exec rake db:migrate
```

### **2. Create Procfile (for Heroku-style platforms)**
```
web: vendor/bin/heroku-php-apache2 public/
```

### **3. Update composer.json**
Add to `scripts` section:
```json
"scripts": {
    "post-install-cmd": [
        "php artisan key:generate --force",
        "php artisan config:cache",
        "php artisan route:cache",
        "php artisan view:cache"
    ]
}
```

## 🔧 **Post-Deployment Setup**

### **1. Run Migrations**
```bash
php artisan migrate --force
```

### **2. Clear Caches**
```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
```

### **3. Set Storage Permissions**
```bash
chmod -R 775 storage bootstrap/cache
```

## 🌍 **Custom Domain Setup**

### **Railway:**
1. Go to your app settings
2. Add custom domain
3. Update DNS records

### **Render:**
1. Go to app settings
2. Add custom domain
3. Update DNS records

## 📊 **Monitoring & Maintenance**

### **Free Tools:**
- **UptimeRobot**: Monitor uptime
- **Google Analytics**: Track visitors
- **Railway Dashboard**: Monitor resources

## 💰 **Cost Optimization**

### **Railway Free Tier:**
- $5 credit monthly
- Auto-scaling
- Pay only for usage

### **Render Free Tier:**
- 750 hours/month
- Perfect for development
- Upgrade when needed

## 🆘 **Troubleshooting**

### **Common Issues:**
1. **Build fails**: Check build logs
2. **Database connection**: Verify environment variables
3. **500 errors**: Check Laravel logs
4. **Assets not loading**: Ensure `npm run build` completed

### **Get Help:**
- Railway Discord: [discord.gg/railway](https://discord.gg/railway)
- Render Community: [community.render.com](https://community.render.com)

## 🎉 **Success!**
Your DemoShop will be live at: `https://your-app-name.railway.app`

---

**Next Steps:**
1. Choose Railway (recommended) or Render
2. Follow the deployment steps
3. Set up your database
4. Deploy and test!

Need help? Check the troubleshooting section or ask in the community forums!
