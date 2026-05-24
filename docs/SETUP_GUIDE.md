# Complete Setup Guide - Inventory Management System

This guide walks you through setting up and running the complete Inventory Management System with both backend (Laravel) and frontend (React).

## System Requirements

### Backend
- PHP 8.4+
- Composer
- MySQL 8.4
- Redis
- Laragon (or similar LAMP/LEMP stack)

### Frontend
- Node.js 18+
- npm or yarn

## Quick Start (5 Minutes)

### 1. Start Backend Services

Make sure Laragon is running with:
- MySQL server
- Redis server (optional, but recommended)
- Apache/Nginx server

### 2. Start Backend API

```bash
# Navigate to backend folder
cd D:\laragon\www\inventory_management\backend

# Start Laravel development server
php artisan serve
```

Backend API will be available at: `http://localhost:8000`

### 3. Start Frontend Dev Server

Open a new terminal:

```bash
# Navigate to frontend folder
cd D:\laragon\www\inventory_management\frontend

# Install dependencies (first time only)
npm install

# Start development server
npm run dev
```

Frontend will be available at: `http://localhost:5173`

### 4. Login

Open browser to `http://localhost:5173`

**Test Credentials:**
- Email: `admin@inventory.com`
- Password: `password`

## Detailed Backend Setup

### Initial Installation (If Not Done Already)

```bash
# Navigate to project root
cd D:\laragon\www\inventory_management

# Create backend directory
mkdir backend
cd backend

# Install Laravel
composer create-project laravel/laravel .

# Install Sanctum
composer require laravel/sanctum

# Install Predis for Redis support
composer require predis/predis
```

### Database Setup

1. Create MySQL database:
```sql
CREATE DATABASE inventory_management;
```

2. Configure `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventory_management
DB_USERNAME=root
DB_PASSWORD=

REDIS_CLIENT=predis
CACHE_STORE=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis
```

3. Run migrations and seeders:
```bash
php artisan migrate --seed
```

### Test Backend API

```bash
# Test login endpoint
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{"email":"admin@inventory.com","password":"password"}'
```

## Detailed Frontend Setup

### Initial Installation

```bash
# Navigate to project root
cd D:\laragon\www\inventory_management

# Create frontend with Vite
mkdir frontend
cd frontend

# Install Vite with React + TypeScript template
npm create vite@latest . -- --template react-ts

# Install dependencies
npm install

# Install additional packages
npm install @tanstack/react-query @tanstack/react-query-devtools
npm install zustand axios react-hook-form zod @hookform/resolvers
npm install react-router-dom clsx tailwind-merge lucide-react sonner

# Install Tailwind CSS
npm install -D tailwindcss postcss autoprefixer
```

### Configure Environment

Create `.env`:
```env
VITE_API_BASE_URL=http://localhost:8000
```

### Test Frontend

```bash
npm run dev
```

Open `http://localhost:5173` and login with test credentials.

## Project Structure

```
inventory_management/
├── backend/                    # Laravel API
│   ├── app/
│   │   ├── Http/
│   │   │   ├── Controllers/   # API Controllers
│   │   │   ├── Requests/      # Form Requests
│   │   │   └── Resources/     # API Resources
│   │   └── Models/            # Eloquent Models
│   ├── database/
│   │   ├── migrations/        # Database migrations
│   │   └── seeders/           # Database seeders
│   ├── routes/
│   │   └── api.php            # API routes
│   └── .env                   # Backend environment
│
├── frontend/                   # React App
│   ├── src/
│   │   ├── api/               # API client
│   │   ├── components/        # React components
│   │   ├── pages/             # Page components
│   │   ├── store/             # Zustand stores
│   │   ├── types/             # TypeScript types
│   │   └── utils/             # Utilities
│   └── .env                   # Frontend environment
│
└── docs/                       # Documentation
    ├── postman/               # Postman collection
    └── README.md              # This file
```

## Available API Endpoints

### Public Endpoints
- `POST /api/register` - Register new user
- `POST /api/login` - User login

### Protected Endpoints (Require Bearer Token)
- `POST /api/logout` - Logout user
- `GET /api/me` - Get current user
- `GET /api/users` - List users (paginated)
- `POST /api/users` - Create user
- `GET /api/users/{id}` - Get user by ID
- `PUT /api/users/{id}` - Update user
- `DELETE /api/users/{id}` - Delete user

## Testing with Postman

1. Import collection from `docs/postman/Inventory_Management_API.postman_collection.json`
2. Import environment from `docs/postman/Inventory_Management.postman_environment.json`
3. Run "1. Register / Login" → "Login" request
4. Token will be automatically saved
5. Test other endpoints

## Default Users & Roles

All users have password: `password`

| Email | Role | Description |
|-------|------|-------------|
| admin@inventory.com | Admin | Full system access |
| manager@inventory.com | Manager | Management access |
| storekeeper@inventory.com | Store Keeper | Warehouse management |
| sales@inventory.com | Sales Staff | Sales operations |
| accountant@inventory.com | Accountant | Financial access |
| auditor@inventory.com | Read-only Auditor | View-only access |

## Common Commands

### Backend
```bash
# Run migrations
php artisan migrate

# Seed database
php artisan db:seed

# Clear cache
php artisan cache:clear

# Run queue worker
php artisan queue:work

# Start dev server
php artisan serve
```

### Frontend
```bash
# Install dependencies
npm install

# Start dev server
npm run dev

# Build for production
npm run build

# Preview production build
npm run preview

# Run linter
npm run lint
```

## Troubleshooting

### Backend Issues

**Issue:** Port 8000 already in use
```bash
# Use different port
php artisan serve --port=8080
# Update frontend .env: VITE_API_BASE_URL=http://localhost:8080
```

**Issue:** Redis connection failed
```bash
# Check if Redis is running in Laragon
# Or disable Redis in backend .env:
CACHE_STORE=file
QUEUE_CONNECTION=database
SESSION_DRIVER=file
```

**Issue:** Database connection failed
```bash
# Check MySQL is running
# Verify credentials in .env
# Create database manually:
mysql -u root -e "CREATE DATABASE inventory_management;"
```

### Frontend Issues

**Issue:** Cannot connect to API
- Check backend server is running on port 8000
- Verify VITE_API_BASE_URL in frontend .env
- Check browser console for CORS errors

**Issue:** Port 5173 already in use
```bash
# Edit vite.config.ts and change port:
server: {
  port: 5174,
}
```

**Issue:** Blank page after login
- Check browser console for errors
- Verify token is being stored in localStorage
- Check API response format matches frontend types

## Production Deployment

### Backend
```bash
cd backend
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Frontend
```bash
cd frontend
npm run build
# Deploy dist/ folder to web server
```

## Development Workflow

1. **Make Backend Changes**
   - Edit controllers, models, migrations
   - Test with Postman
   - Document in API_DOCUMENTATION.md

2. **Make Frontend Changes**
   - Edit components, pages, stores
   - Test in browser
   - Check TypeScript errors

3. **Update Documentation**
   - Update README files
   - Update API documentation
   - Update Postman collection

## Next Features to Implement

### Backend
- [ ] Products CRUD API
- [ ] Categories API
- [ ] Suppliers API
- [ ] Orders API
- [ ] Inventory tracking
- [ ] Reports API

### Frontend
- [ ] Products management page
- [ ] Categories management
- [ ] Suppliers management
- [ ] Orders management
- [ ] Inventory dashboard
- [ ] Reports & analytics

## Resources

### Backend Documentation
- [Backend README](../backend/README.md)
- [API Documentation](../backend/API_DOCUMENTATION.md)
- [Backend Setup Summary](../backend/SETUP_SUMMARY.md)

### Frontend Documentation
- [Frontend README](../frontend/README.md)

### Postman
- [Postman README](./postman/README.md)
- [Postman Quick Start](./postman/QUICK_START.md)

## Support

For issues or questions:
1. Check troubleshooting section above
2. Review documentation files
3. Check Laravel/React documentation
4. Review API responses in Postman

---

**Last Updated:** 2026-05-24
**Version:** 1.0.0
