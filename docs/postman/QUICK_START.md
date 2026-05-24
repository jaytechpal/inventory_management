# 🚀 Quick Start Guide - Postman Setup

## Step-by-Step Instructions (5 minutes)

### Step 1: Import Collection ⬇️

1. Open **Postman**
2. Click **"Import"** button (top left)
3. Drag `Inventory_Management_API.postman_collection.json` into the import window
4. Click **"Import"**

✅ You should now see **"Inventory Management API"** in your collections

---

### Step 2: Import Environment ⚙️

1. Click the **gear icon** (⚙️) in top right corner
2. Click **"Import"** button
3. Drag `Inventory_Management.postman_environment.json` into the import window
4. Click **"Import"**

✅ You should now see **"Inventory Management - Local"** in environments

---

### Step 3: Select Environment 🎯

1. Click the **environment dropdown** (top right, next to the eye icon)
2. Select **"Inventory Management - Local"**

✅ The environment is now active (you'll see it highlighted)

---

### Step 4: Start Laravel Server 🔧

Open terminal and run:
```bash
cd backend
php artisan serve
```

✅ Server should be running at: `http://localhost:8000`

---

### Step 5: Test Login 🔐

1. In Postman, expand **"Inventory Management API"** collection
2. Expand **"Authentication"** folder
3. Click **"Login"** request
4. Click the blue **"Send"** button

✅ You should see a 200 OK response with user data and access token

🎉 **The token is automatically saved!** All other requests will now work.

---

## Test Users

All users have password: `password`

| Email | Role |
|-------|------|
| admin@inventory.com | Admin |
| manager@inventory.com | Manager |
| storekeeper@inventory.com | Store Keeper |
| sales@inventory.com | Sales Staff |
| accountant@inventory.com | Accountant |
| auditor@inventory.com | Read-only Auditor |

---

## What's Next?

Try these requests in order:

1. ✅ **Login** (already done!)
2. 📋 **Get Current User** - See your profile
3. 👥 **List Users** - View all users
4. ➕ **Create User** - Add a new user
5. ✏️ **Update User** - Modify user info
6. 🗑️ **Delete User** - Remove a user
7. 🚪 **Logout** - End your session

---

## 💡 Pro Tips

### Automatic Token Management
- Login and Register requests **automatically save** the token
- You don't need to copy/paste tokens manually
- Token is stored in `{{auth_token}}` environment variable

### View Token
1. Click the **eye icon** (👁️) next to environment dropdown
2. See current `auth_token` value

### Search Users
Add query parameters to "List Users":
```
?search=admin
?is_active=1
?per_page=10
```

### Test in Console
Open Postman Console (View → Show Postman Console) to see:
- Request details
- Response data
- Script output
- Token save confirmation

---

## 🆘 Troubleshooting

### "Unauthenticated" Error
**Solution:** Login first, token saves automatically

### "Connection Refused"
**Solution:** Start Laravel server: `php artisan serve`

### Token Not Saving
**Solution:** Check Postman Console for script errors

### Validation Error
**Solution:** Check request body matches the example format

---

## 📚 Full Documentation

For complete API documentation, see:
- [README.md](./README.md) - Detailed Postman guide
- [API_DOCUMENTATION.md](../../backend/API_DOCUMENTATION.md) - API reference

---

**Ready to test your API!** 🎉
