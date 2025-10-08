@echo off
REM GrowDev Project Quick Start Script
echo 🚀 GrowDev Project Quick Start
echo ===============================

echo 📋 Checking project status...

REM Check if dependencies are installed
if not exist "vendor\" (
    echo 📦 Installing PHP dependencies...
    php composer install --no-dev --optimize-autoloader
)

if not exist "node_modules\" (
    echo 📦 Installing Node.js dependencies...
    npm install
)

REM Clear caches and build assets
echo 🧹 Clearing caches...
php artisan config:clear
php artisan route:clear

echo 🔨 Building frontend assets...
npm run build

echo � Checking application key...
php artisan key:generate --show >nul 2>nul || php artisan key:generate

echo ✅ Project ready!
echo 🌐 Starting development server...
echo    Visit: http://127.0.0.1:8000
echo.
php artisan serve
            exit /b 1
        )
    )
) else (
    echo ✅ Composer found in PATH
    set COMPOSER_CMD=composer
    composer --version | findstr /C:"Composer"
)

where node >nul 2>nul
if %errorlevel% neq 0 (
    echo ❌ Node.js is not installed or not in PATH
    echo    Please install Node.js 20 or higher
    pause
    exit /b 1
) else (
    echo ✅ Node.js found
    node --version
)

where npm >nul 2>nul
if %errorlevel% neq 0 (
    echo ❌ NPM is not installed or not in PATH
    pause
    exit /b 1
) else (
    echo ✅ NPM found
    npm --version
)

REM Check if .env file exists
echo.
echo 🔧 Setting up environment...

if not exist ".env" (
    if exist ".env.example" (
        copy .env.example .env >nul
        echo ✅ Created .env file from .env.example
    ) else (
        echo ❌ .env.example file not found
        pause
        exit /b 1
    )
) else (
    echo ℹ️ .env file already exists
)

REM Install Composer dependencies
echo.
echo 📦 Installing PHP dependencies...
%COMPOSER_CMD% install --no-interaction --optimize-autoloader

if %errorlevel% neq 0 (
    echo ❌ Failed to install Composer dependencies
    pause
    exit /b 1
)

echo ✅ PHP dependencies installed

REM Install NPM dependencies
echo.
echo 📦 Installing JavaScript dependencies...
npm install

if %errorlevel% neq 0 (
    echo ❌ Failed to install NPM dependencies
    pause
    exit /b 1
)

echo ✅ JavaScript dependencies installed

REM Generate Laravel application key
echo.
echo 🔑 Generating application key...
php artisan key:generate --ansi

if %errorlevel% neq 0 (
    echo ❌ Failed to generate application key
    pause
    exit /b 1
)

echo ✅ Application key generated

REM Create storage symbolic link
echo.
echo 🔗 Creating storage link...
php artisan storage:link

REM Supabase configuration info
echo.
echo 🗄️ Supabase Configuration
echo =========================
echo.
echo Please update your .env file with your Supabase credentials:
echo.
echo SUPABASE_URL=https://bwrxvijpmhnuevdrtxcy.supabase.co
echo SUPABASE_ANON_KEY=your_anon_key_here
echo SUPABASE_SERVICE_ROLE_KEY=your_service_role_key_here
echo.
echo Database Schema Setup:
echo 1. Go to your Supabase dashboard
echo 2. Navigate to SQL Editor
echo 3. Run the SQL script from: database/migrations/supabase_schema.sql
echo.

REM Build assets
echo.
echo 🎨 Building frontend assets...
npm run build

if %errorlevel% neq 0 (
    echo ❌ Failed to build assets
    pause
    exit /b 1
)

echo ✅ Assets built successfully

REM Final instructions
echo.
echo 🎉 Setup Complete!
echo ==================
echo.
echo Next steps:
echo 1. Update your .env file with Supabase credentials
echo 2. Run the Supabase schema SQL in your database
echo 3. Start the development server:
echo    php artisan serve
echo.
echo 4. In another terminal, start the asset watcher:
echo    npm run dev
echo.
echo 5. Visit http://localhost:8000 to see your application
echo.
echo For more information, see the README.md file
echo.

REM Ask if user wants to start the server
set /p start_server="Would you like to start the development server now? (y/n): "
if /i "%start_server%"=="y" (
    echo 🚀 Starting development server...
    php artisan serve
)

pause