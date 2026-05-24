# Postman Files Index

This directory contains everything you need to test the Inventory Management API with Postman.

## 📦 Files

| File | Purpose | Size |
|------|---------|------|
| **Inventory_Management_API.postman_collection.json** | Complete API collection with all 10 endpoints | Collection |
| **Inventory_Management.postman_environment.json** | Environment variables for local development | Environment |
| **QUICK_START.md** | 5-minute setup guide | Guide |
| **README.md** | Comprehensive documentation | Reference |

## 🎯 Choose Your Path

### 👉 New to Postman?
Start here: **[QUICK_START.md](./QUICK_START.md)**
- Simple step-by-step instructions
- Takes only 5 minutes
- Get testing immediately

### 👉 Experienced User?
Jump to: **[README.md](./README.md)**
- Detailed documentation
- Advanced features
- Troubleshooting guide
- Testing workflows

## 🚀 Quick Import

**Collection:**
```
Import → Inventory_Management_API.postman_collection.json
```

**Environment:**
```
Manage Environments (⚙️) → Import → Inventory_Management.postman_environment.json
```

## 📊 Collection Contents

### Authentication (4 endpoints)
- POST `/api/register` - Register user
- POST `/api/login` - Login
- POST `/api/logout` - Logout  
- GET `/api/me` - Get profile

### User Management (6 endpoints)
- GET `/api/users` - List users
- POST `/api/users` - Create user
- GET `/api/users/:id` - Get user
- PUT `/api/users/:id` - Update (full)
- PATCH `/api/users/:id` - Update (partial)
- DELETE `/api/users/:id` - Delete user

**Total: 10 API endpoints** ✅

## 🔑 Test Credentials

| User | Email | Password |
|------|-------|----------|
| Admin | admin@inventory.com | password |
| Manager | manager@inventory.com | password |
| Store Keeper | storekeeper@inventory.com | password |
| Sales Staff | sales@inventory.com | password |
| Accountant | accountant@inventory.com | password |
| Auditor | auditor@inventory.com | password |

## ✨ Features

✅ **Automatic token management** - No manual copy/paste  
✅ **Pre-filled request bodies** - Example data included  
✅ **Detailed descriptions** - Each endpoint documented  
✅ **Query parameters** - Pagination and filtering ready  
✅ **Test scripts** - Token automatically saved  
✅ **Environment variables** - Easy configuration  

## 📱 What You Get

After importing, you'll have:
- Complete working API collection
- All endpoints configured and tested
- Automatic authentication handling
- Sample data for quick testing
- Full documentation

## 🎓 Learning Resources

1. **QUICK_START.md** - Get started in 5 minutes
2. **README.md** - Complete guide with examples
3. **[API_DOCUMENTATION.md](../../backend/API_DOCUMENTATION.md)** - Full API reference
4. **[Backend README](../../backend/README.md)** - Laravel setup guide

## 🔄 Version History

**Version 1.0.0** (May 24, 2026)
- Initial release
- 10 API endpoints
- Laravel 13 support
- Sanctum authentication
- Role-based access control

## 🆘 Quick Help

**Q: Token not saving?**  
A: Check Postman Console (View → Show Postman Console)

**Q: Connection refused?**  
A: Start Laravel server: `php artisan serve`

**Q: Validation errors?**  
A: Check request body format in examples

**Q: Need more help?**  
A: See [README.md](./README.md) troubleshooting section

---

**Ready to test?** Import the files and start with [QUICK_START.md](./QUICK_START.md) 🚀
