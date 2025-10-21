# GrowDev - Documentation Index

## 📚 Quick Navigation

### 🚀 Getting Started
Start here if you're new to the project:
- **[README.md](README.md)** - Complete project overview, features, and basic usage

### 🔧 Development & Deployment
For developers setting up or deploying:
- **[SETUP_GUIDE.md](SETUP_GUIDE.md)** - Development commands, deployment steps, troubleshooting

### 📋 Project Changes
What was done to clean up the project:
- **[CLEANUP_REPORT.md](CLEANUP_REPORT.md)** - List of removed files, cleanup details, optimization tips

---

## 📖 Documentation by Use Case

### "I want to start the project"
1. Read: [README.md](README.md) - Installation section
2. Run: Follow the setup steps
3. Access: `http://127.0.0.1:8000`

### "I want to deploy to production"
1. Read: [SETUP_GUIDE.md](SETUP_GUIDE.md) - Production Deployment section
2. Follow: Deployment steps
3. Verify: Security checklist

### "Something is broken"
1. Check: [SETUP_GUIDE.md](SETUP_GUIDE.md) - Troubleshooting section
2. Run: Cache clearing commands
3. Verify: Database connection

### "I want to add a new feature"
1. Read: [README.md](README.md) - File Structure section
2. Review: [SETUP_GUIDE.md](SETUP_GUIDE.md) - Development Commands
3. Reference: Comment your changes clearly

### "What was cleaned up?"
1. Read: [CLEANUP_REPORT.md](CLEANUP_REPORT.md) - Complete cleanup list

---

## 🎯 Key Features Overview

### 🔐 Authentication
- TOTP-based 2FA using Google Authenticator
- Direct TOTP password reset (no email needed)
- Rate limiting: 3 attempts/minute

### 📄 CV Management
- Professional CV editor with 4 sections
- Work experience tracking
- Education management
- Skills with proficiency levels
- Certifications storage
- PDF export functionality

### 🛡️ Security
- CSRF protection on all forms
- XSS prevention through Blade
- Database transactions for data integrity
- Rate limiting
- User-specific data access

---

## 💾 Database

**8 Tables:**
- `users` - User accounts & TOTP secrets
- `work_experiences` - Job positions
- `educations` - Educational background
- `skills` - Skills with proficiency
- `certifications` - Credentials
- `projects` - User projects
- `sessions` - Session storage
- `jobs` - Background jobs

**Relationships:**
- User → Many WorkExperiences (cascading delete)
- User → Many Educations (cascading delete)
- User → Many Skills (cascading delete)
- User → Many Certifications (cascading delete)
- User → Many Projects (cascading delete)

---

## 🛣️ Main Routes

| Route | Method | Purpose |
|-------|--------|---------|
| `/` | GET | Welcome page |
| `/register` | GET/POST | User registration |
| `/register/totp-setup` | GET/POST | TOTP setup |
| `/login` | GET/POST | User login |
| `/forgot-password` | GET/POST | Password reset |
| `/dashboard` | GET | User dashboard |
| `/profile` | GET | CV editor |
| `/profile` | PUT | Save CV changes |
| `/profile/cv-pdf` | GET | Download CV as PDF |

---

## 🔄 Typical Workflow

### User Registration & Setup
```
1. User goes to /register
2. Fills form and submits
3. Redirected to /register/totp-setup
4. Scans QR code with Google Authenticator
5. Enters TOTP code to verify
6. Registration complete, auto-logged in
```

### CV Management
```
1. User logs in
2. Navigates to /profile
3. Fills in CV information
4. Clicks "Save Changes"
5. CV saved to database
6. Can click "Export PDF" to download
```

### Password Reset
```
1. User goes to /forgot-password
2. Enters email address
3. Receives TOTP prompt
4. Enters code from Google Authenticator
5. Sets new password
6. Auto-logged in with new password
```

---

## 🚀 Commands Reference

### Development
```bash
# Start server
php artisan serve

# Watch assets
npm run dev

# Run tests
php artisan test

# Clear caches
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

### Database
```bash
# Run migrations
php artisan migrate

# Seed data
php artisan db:seed --class=TestUserSeeder

# Reset & seed
php artisan migrate:refresh --seed
```

### Production
```bash
# Optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Build assets
npm run build

# Install production dependencies
composer install --optimize-autoloader --no-dev
```

---

## 📱 Test Account

- **Email**: test@example.com
- **Password**: password

(Available after running `php artisan db:seed --class=TestUserSeeder`)

---

## ✅ Quality Checklist

The project includes:
- ✅ Type hints on all methods
- ✅ Comprehensive validation rules
- ✅ Database transaction support
- ✅ Proper error handling
- ✅ Security-first design
- ✅ Clean code structure
- ✅ Responsive design
- ✅ Production-ready configuration

---

## 🔍 File Organization

**Core Application**
- `app/` - PHP classes and logic
- `config/` - Configuration files
- `database/` - Migrations and seeds
- `routes/` - Route definitions
- `resources/views/` - Blade templates

**Frontend**
- `resources/css/` - Tailwind stylesheets
- `resources/js/` - JavaScript files
- `public/` - Public assets

**Development**
- `tests/` - Unit and feature tests
- `bootstrap/` - Framework bootstrapping
- `storage/` - Logs and cache

---

## 🆘 Quick Help

**Need to...** | **File to check**
---|---
Start development | SETUP_GUIDE.md
Deploy to production | SETUP_GUIDE.md
Learn about features | README.md
Find what changed | CLEANUP_REPORT.md
Understand routes | README.md (Routes section)
Debug an issue | SETUP_GUIDE.md (Troubleshooting)

---

## 📞 Support

For any questions or issues:
1. Check the relevant documentation above
2. Review error logs in `storage/logs/`
3. Verify database connection and migrations
4. Ensure all dependencies are installed

---

**Last Updated**: October 21, 2025  
**Project Status**: Clean & Production-Ready ✅
