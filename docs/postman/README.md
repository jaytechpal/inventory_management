# Postman Collection & Environment for Inventory Management API

This folder contains Postman collection and environment files for testing the Inventory Management REST API.

## Files

1. **Inventory_Management_API.postman_collection.json**
   - Complete API collection with all endpoints
   - Pre-configured request bodies and headers
   - Automatic token management via test scripts
   - Detailed descriptions for each endpoint

2. **Inventory_Management.postman_environment.json**
   - Environment variables for local development
   - Pre-configured test user credentials
   - Base URL configuration
   - Token storage variable

## Quick Start

### 1. Import into Postman

**Import Collection:**
1. Open Postman
2. Click "Import" button (top left)
3. Drag and drop `Inventory_Management_API.postman_collection.json` or click "Upload Files"
4. Click "Import"

**Import Environment:**
1. Click the gear icon (⚙️) in the top right corner
2. Click "Import" button
3. Drag and drop `Inventory_Management.postman_environment.json` or click "Upload Files"
4. Click "Import"

### 2. Select Environment

1. In the top right corner, click the environment dropdown
2. Select "Inventory Management - Local"
3. The environment is now active

### 3. Start the Laravel Server

Make sure your Laravel server is running:
```bash
cd backend
php artisan serve
```

The API will be available at: `http://localhost:8000`

### 4. Test the API

#### Option A: Login with Admin User
1. Open the "Authentication" folder
2. Click on "Login" request
3. Click "Send"
4. The token will be automatically saved to the environment variable `auth_token`
5. All authenticated requests will now work automatically

#### Option B: Login with Other Test Users
Change the email in the login request body to one of these test accounts:
- `manager@inventory.com`
- `storekeeper@inventory.com`
- `sales@inventory.com`
- `accountant@inventory.com`
- `auditor@inventory.com`

All test users have password: `password`

### 5. Test Other Endpoints

After logging in, you can test all other endpoints:
- **Get Current User** - View your profile
- **List Users** - View all users (paginated)
- **Create User** - Add new users
- **Update User** - Modify user information
- **Delete User** - Remove users

## Collection Features

### 🔐 Automatic Token Management

The Login and Register endpoints include test scripts that automatically:
- Extract the access token from the response
- Save it to the environment variable `auth_token`
- Make it available for all authenticated requests

**Test Script (Login/Register):**
```javascript
if (pm.response.code === 200 || pm.response.code === 201) {
    var jsonData = pm.response.json();
    if (jsonData.data && jsonData.data.access_token) {
        pm.environment.set("auth_token", jsonData.data.access_token);
        console.log("Token saved: " + jsonData.data.access_token);
    }
}
```

### 📝 Request Examples

All requests include:
- Pre-filled request bodies with example data
- Proper headers (Content-Type, Accept)
- Authentication configuration
- Detailed descriptions
- Parameter explanations

### 🔍 Query Parameters

The "List Users" endpoint includes query parameters for:
- `per_page` - Results per page (default: 15)
- `search` - Search by name or email
- `is_active` - Filter by active status

Example:
```
GET /api/users?per_page=10&search=john&is_active=1
```

## Environment Variables

### Pre-configured Variables

| Variable | Value | Description |
|----------|-------|-------------|
| `base_url` | http://localhost:8000 | API base URL |
| `auth_token` | (empty) | Bearer token (auto-populated) |
| `admin_email` | admin@inventory.com | Admin test user email |
| `manager_email` | manager@inventory.com | Manager test user email |
| `storekeeper_email` | storekeeper@inventory.com | Store keeper email |
| `sales_email` | sales@inventory.com | Sales staff email |
| `accountant_email` | accountant@inventory.com | Accountant email |
| `auditor_email` | auditor@inventory.com | Auditor email |
| `admin_password` | password | Admin password |
| `test_password` | password | Test users password |

### Using Variables in Requests

You can use environment variables in your requests:
```
{{base_url}}/api/users
Authorization: Bearer {{auth_token}}
```

### Viewing/Editing Variables

1. Click the eye icon (👁️) next to the environment dropdown
2. View current values
3. Click "Edit" to modify values

## API Endpoints Included

### Authentication (Public)
- ✅ **POST** `/api/register` - Register new user
- ✅ **POST** `/api/login` - Login and get token

### Authentication (Protected)
- ✅ **POST** `/api/logout` - Logout and revoke token
- ✅ **GET** `/api/me` - Get current user info

### User Management (Protected)
- ✅ **GET** `/api/users` - List users (paginated)
- ✅ **POST** `/api/users` - Create new user
- ✅ **GET** `/api/users/:id` - Get user details
- ✅ **PUT** `/api/users/:id` - Update user (full)
- ✅ **PATCH** `/api/users/:id` - Update user (partial)
- ✅ **DELETE** `/api/users/:id` - Delete user

## Available Roles

When creating or updating users, use these role IDs:

| ID | Role Name | Slug | Description |
|----|-----------|------|-------------|
| 1 | Admin | admin | Full system access |
| 2 | Manager | manager | Management level access |
| 3 | Store Keeper | store-keeper | Inventory management |
| 4 | Sales Staff | sales-staff | Sales transactions |
| 5 | Accountant | accountant | Financial records |
| 6 | Read-only Auditor | read-only-auditor | View-only access |

## Testing Workflow

### Typical Testing Flow:

1. **Login**
   ```
   POST /api/login
   Body: { "email": "admin@inventory.com", "password": "password" }
   ```
   Token is automatically saved ✅

2. **View Your Profile**
   ```
   GET /api/me
   ```

3. **List All Users**
   ```
   GET /api/users?per_page=15
   ```

4. **Create New User**
   ```
   POST /api/users
   Body: { "name": "...", "email": "...", "password": "...", "role_ids": [3] }
   ```

5. **Update User**
   ```
   PUT /api/users/7
   Body: { "name": "Updated Name", "is_active": false }
   ```

6. **Delete User**
   ```
   DELETE /api/users/7
   ```

7. **Logout**
   ```
   POST /api/logout
   ```

## Troubleshooting

### "Unauthenticated" Error
- Make sure you've logged in first
- Check that the `auth_token` variable is set (view environment variables)
- Token might have expired - login again

### Connection Refused
- Ensure Laravel server is running: `php artisan serve`
- Check that `base_url` is correct in environment variables
- Verify server is running on port 8000

### Validation Errors
- Check request body format
- Ensure all required fields are provided
- Verify data types (strings, integers, arrays)

### Token Not Saving
- Check Postman console (View → Show Postman Console)
- Verify the test script ran successfully
- Look for "Token saved" message in console

## Advanced Usage

### Creating Test Scenarios

You can create test scenarios using Postman's Runner:

1. Click "Runner" button
2. Select the collection
3. Select environment
4. Choose requests to run
5. Set iterations and delay
6. Click "Run"

### Pre-request Scripts

Add custom pre-request scripts for dynamic data:
```javascript
// Generate random email
pm.environment.set("random_email", "user" + Math.random().toString(36).substring(7) + "@test.com");
```

### Collection Variables

You can also use collection-level variables:
```javascript
pm.collectionVariables.set("variable_name", "value");
```

## Production Environment

To create a production environment:

1. Duplicate the environment
2. Rename to "Inventory Management - Production"
3. Update `base_url` to production URL
4. Clear `auth_token`
5. Update test credentials (don't use default passwords!)

## Support

For API documentation, see:
- [API_DOCUMENTATION.md](../../backend/API_DOCUMENTATION.md)
- [README.md](../../backend/README.md)

## Version

- **Collection Version:** 1.0.0
- **API Version:** Laravel 13
- **Last Updated:** May 24, 2026
