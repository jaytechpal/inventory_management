# Inventory Management System - Backend

A REST API built with Laravel 13 for inventory management system with role-based authentication.

## Features

- ✅ Laravel 13 Framework
- ✅ MySQL 8.4 Database
- ✅ Laravel Sanctum for API Authentication
- ✅ Redis for Caching, Queues, and Sessions
- ✅ Role-Based Access Control
- ✅ RESTful API Architecture
- ✅ Comprehensive API Documentation
- ✅ Sample Data Seeding

## Requirements

- PHP 8.4+
- Composer
- MySQL 8.4+
- Redis Server
- Laragon (recommended for Windows)

## Installation

### 1. Install Dependencies

```bash
cd backend
composer install
```

### 2. Environment Configuration

The `.env` file is already configured. Update if needed:

```env
APP_NAME="Inventory Management"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventory_management
DB_USERNAME=root
DB_PASSWORD=

# Redis Configuration
REDIS_CLIENT=predis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

# Cache, Queue, and Session Configuration
CACHE_STORE=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis
```

### 3. Database Setup

The database has already been created and migrated with sample data. To reset:

```bash
php artisan migrate:fresh --seed
```

This will create:
- Users table with role relationships
- Roles table with 6 predefined roles
- Personal access tokens table (Sanctum)
- Cache and jobs tables
- Sample users for each role

### 4. Start Development Server

```bash
php artisan serve
```

The API will be available at: `http://localhost:8000/api`

### 5. Run Queue Worker (Optional)

```bash
php artisan queue:work redis
```

## Available Roles

The system includes 6 predefined roles:

1. **Admin** - Full system access and administration privileges
2. **Manager** - Management level access with oversight capabilities
3. **Store Keeper** - Manages inventory and warehouse operations
4. **Sales Staff** - Handles sales transactions and customer interactions
5. **Accountant** - Manages financial records and transactions
6. **Read-only Auditor** - View-only access for auditing purposes

## Sample Users

Test users are pre-seeded with password `password`:

| Email | Role | Password |
|-------|------|----------|
| admin@inventory.com | Admin | password |
| manager@inventory.com | Manager | password |
| storekeeper@inventory.com | Store Keeper | password |
| sales@inventory.com | Sales Staff | password |
| accountant@inventory.com | Accountant | password |
| auditor@inventory.com | Read-only Auditor | password |

## API Endpoints

### Authentication
- `POST /api/register` - Register new user
- `POST /api/login` - Login user
- `POST /api/logout` - Logout user (authenticated)
- `GET /api/me` - Get authenticated user info

### User Management
- `GET /api/users` - List all users (paginated)
- `POST /api/users` - Create new user
- `GET /api/users/{id}` - Get user details
- `PUT/PATCH /api/users/{id}` - Update user
- `DELETE /api/users/{id}` - Delete user

## API Documentation

Detailed API documentation is available in [API_DOCUMENTATION.md](./API_DOCUMENTATION.md)

## Project Structure

```
backend/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── Api/
│   │   │       ├── AuthController.php
│   │   │       └── UserController.php
│   │   ├── Requests/
│   │   │   ├── LoginRequest.php
│   │   │   ├── RegisterRequest.php
│   │   │   ├── StoreUserRequest.php
│   │   │   └── UpdateUserRequest.php
│   │   └── Resources/
│   │       └── UserResource.php
│   └── Models/
│       ├── User.php
│       └── Role.php
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 2026_05_24_125419_create_personal_access_tokens_table.php
│   │   ├── 2026_05_24_125644_create_roles_table.php
│   │   └── 2026_05_24_125654_create_role_user_table.php
│   └── seeders/
│       ├── RoleSeeder.php
│       └── UserSeeder.php
├── routes/
│   ├── api.php
│   ├── web.php
│   └── console.php
├── .env
└── API_DOCUMENTATION.md
```

## Laravel Standards & Best Practices

This project follows Laravel's official coding standards and best practices:

### Code Style
- PSR-12 coding standard
- Laravel naming conventions for models, controllers, and methods
- Eloquent relationships properly defined
- Form Request validation for input validation

### Architecture
- Repository pattern not implemented (following Laravel's convention)
- Service layer not implemented (controllers handle business logic)
- Resource classes for API responses
- API versioning ready (via /api prefix)

### Security
- Laravel Sanctum for API authentication
- Password hashing using bcrypt
- CSRF protection (automatic for web routes)
- SQL injection prevention (Eloquent ORM)
- XSS protection (automatic output escaping)

### Database
- Migration files for version control
- Seeders for sample data
- Foreign key constraints
- Proper indexing on frequently queried fields

### Performance
- Redis caching enabled
- Query optimization with eager loading
- Pagination on list endpoints
- Queue system configured for background jobs

## Testing API with cURL

### Login
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{"email":"admin@inventory.com","password":"password"}'
```

### Create User (Authenticated)
```bash
curl -X POST http://localhost:8000/api/users \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -d '{
    "name":"John Doe",
    "email":"john@example.com",
    "password":"password123",
    "role_ids":[3]
  }'
```

## Important Notes

### Laravel Horizon
Laravel Horizon was requested but cannot be fully installed on Windows due to the PCNTL and POSIX extension requirements. For production deployment on Linux servers, you can install it with:

```bash
composer require laravel/horizon
php artisan horizon:install
```

### Redis
Ensure Redis is running before starting the application:
- On Laragon: Redis should start automatically
- Manual start: Check your Redis installation documentation

### Queue Processing
To process queued jobs, run:
```bash
php artisan queue:work redis
```

For development, you can also use:
```bash
php artisan queue:listen
```

## Troubleshooting

### Database Connection Issues
- Ensure MySQL service is running
- Verify database credentials in `.env`
- Check if `inventory_management` database exists

### Redis Connection Issues
- Ensure Redis service is running
- Verify Redis configuration in `.env`
- Install Predis if not already installed: `composer require predis/predis`

### Authentication Issues
- Clear config cache: `php artisan config:clear`
- Clear route cache: `php artisan route:clear`
- Regenerate app key: `php artisan key:generate`

## License

This project is proprietary software for inventory management purposes.

## Support

For API issues or questions, refer to the [API_DOCUMENTATION.md](./API_DOCUMENTATION.md) file.
