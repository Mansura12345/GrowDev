@echo off
REM GrowDev Quick Run Script
echo 🚀 Starting GrowDev...

REM Build assets if needed
if not exist "public\build\" (
    echo 🔨 Building assets...
    npm run build
)

echo 🌐 Starting server at http://127.0.0.1:8000
php artisan serve