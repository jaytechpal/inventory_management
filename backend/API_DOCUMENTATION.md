# API Documentation - Inventory Management System

## Base URL
```
http://localhost/api
```

## Authentication
This API uses Laravel Sanctum for authentication. After logging in or registering, you will receive an access token that must be included in subsequent requests.

**Header Format:**
```
Authorization: Bearer {your_access_token}
```

---

## Authentication Endpoints

### 1. Register User

Creates a new user account.

**Endpoint:** `POST /register`

**Request Body:**
```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "phone": "+1234567890",
    "role_ids": [1, 2]
}
```

**Request Fields:**
- `name` (required, string, max: 255): User's full name
- `email` (required, email, unique): User's email address
- `password` (required, string, min: 8): User's password
- `password_confirmation` (required, string): Password confirmation
- `phone` (optional, string, max: 20): User's phone number
- `role_ids` (optional, array): Array of role IDs to assign to the user

**Response (201 Created):**
```json
{
    "success": true,
    "message": "User registered successfully",
    "data": {
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "phone": "+1234567890",
            "is_active": true,
            "email_verified_at": null,
            "roles": [
                {
                    "id": 1,
                    "name": "Admin",
                    "slug": "admin",
                    "description": "Full system access and administration privileges"
                }
            ],
            "created_at": "2026-05-24T12:00:00.000000Z",
            "updated_at": "2026-05-24T12:00:00.000000Z"
        },
        "access_token": "1|abc123def456...",
        "token_type": "Bearer"
    }
}
```

---

### 2. Login

Authenticates a user and returns an access token.

**Endpoint:** `POST /login`

**Request Body:**
```json
{
    "email": "admin@inventory.com",
    "password": "password"
}
```

**Request Fields:**
- `email` (required, email): User's email address
- `password` (required, string): User's password

**Response (200 OK):**
```json
{
    "success": true,
    "message": "Login successful",
    "data": {
        "user": {
            "id": 1,
            "name": "Admin User",
            "email": "admin@inventory.com",
            "phone": "+1234567890",
            "is_active": true,
            "email_verified_at": "2026-05-24T12:00:00.000000Z",
            "roles": [
                {
                    "id": 1,
                    "name": "Admin",
                    "slug": "admin",
                    "description": "Full system access and administration privileges"
                }
            ],
            "created_at": "2026-05-24T12:00:00.000000Z",
            "updated_at": "2026-05-24T12:00:00.000000Z"
        },
        "access_token": "2|xyz789abc123...",
        "token_type": "Bearer"
    }
}
```

**Error Response (401 Unauthorized):**
```json
{
    "success": false,
    "message": "Invalid credentials"
}
```

**Error Response (403 Forbidden - Account Deactivated):**
```json
{
    "success": false,
    "message": "Your account has been deactivated"
}
```

---

### 3. Logout

Revokes the current access token.

**Endpoint:** `POST /logout`

**Authentication:** Required

**Response (200 OK):**
```json
{
    "success": true,
    "message": "Logged out successfully"
}
```

---

### 4. Get Authenticated User

Returns the currently authenticated user's information.

**Endpoint:** `GET /me`

**Authentication:** Required

**Response (200 OK):**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "name": "Admin User",
        "email": "admin@inventory.com",
        "phone": "+1234567890",
        "is_active": true,
        "email_verified_at": "2026-05-24T12:00:00.000000Z",
        "roles": [
            {
                "id": 1,
                "name": "Admin",
                "slug": "admin",
                "description": "Full system access and administration privileges"
            }
        ],
        "created_at": "2026-05-24T12:00:00.000000Z",
        "updated_at": "2026-05-24T12:00:00.000000Z"
    }
}
```

---

## User Management Endpoints

All user management endpoints require authentication.

### 5. List Users

Retrieves a paginated list of users with optional filtering.

**Endpoint:** `GET /users`

**Authentication:** Required

**Query Parameters:**
- `per_page` (optional, integer, default: 15): Number of users per page
- `search` (optional, string): Search users by name or email
- `is_active` (optional, boolean): Filter by active status

**Example Request:**
```
GET /users?per_page=10&search=john&is_active=1
```

**Response (200 OK):**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "Admin User",
            "email": "admin@inventory.com",
            "phone": "+1234567890",
            "is_active": true,
            "email_verified_at": "2026-05-24T12:00:00.000000Z",
            "roles": [
                {
                    "id": 1,
                    "name": "Admin",
                    "slug": "admin",
                    "description": "Full system access and administration privileges"
                }
            ],
            "created_at": "2026-05-24T12:00:00.000000Z",
            "updated_at": "2026-05-24T12:00:00.000000Z"
        }
    ],
    "meta": {
        "current_page": 1,
        "last_page": 1,
        "per_page": 15,
        "total": 6
    }
}
```

---

### 6. Create User

Creates a new user (Admin only).

**Endpoint:** `POST /users`

**Authentication:** Required

**Request Body:**
```json
{
    "name": "New User",
    "email": "newuser@example.com",
    "password": "password123",
    "phone": "+1234567890",
    "is_active": true,
    "role_ids": [3]
}
```

**Request Fields:**
- `name` (required, string, max: 255): User's full name
- `email` (required, email, unique): User's email address
- `password` (required, string, min: 8): User's password
- `phone` (optional, string, max: 20): User's phone number
- `is_active` (optional, boolean, default: true): User's active status
- `role_ids` (required, array, min: 1): Array of role IDs to assign

**Response (201 Created):**
```json
{
    "success": true,
    "message": "User created successfully",
    "data": {
        "id": 7,
        "name": "New User",
        "email": "newuser@example.com",
        "phone": "+1234567890",
        "is_active": true,
        "email_verified_at": null,
        "roles": [
            {
                "id": 3,
                "name": "Store Keeper",
                "slug": "store-keeper",
                "description": "Manages inventory and warehouse operations"
            }
        ],
        "created_at": "2026-05-24T12:30:00.000000Z",
        "updated_at": "2026-05-24T12:30:00.000000Z"
    }
}
```

---

### 7. Get User Details

Retrieves details of a specific user.

**Endpoint:** `GET /users/{id}`

**Authentication:** Required

**Response (200 OK):**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "name": "Admin User",
        "email": "admin@inventory.com",
        "phone": "+1234567890",
        "is_active": true,
        "email_verified_at": "2026-05-24T12:00:00.000000Z",
        "roles": [
            {
                "id": 1,
                "name": "Admin",
                "slug": "admin",
                "description": "Full system access and administration privileges"
            }
        ],
        "created_at": "2026-05-24T12:00:00.000000Z",
        "updated_at": "2026-05-24T12:00:00.000000Z"
    }
}
```

---

### 8. Update User

Updates an existing user's information.

**Endpoint:** `PUT /users/{id}` or `PATCH /users/{id}`

**Authentication:** Required

**Request Body:**
```json
{
    "name": "Updated Name",
    "email": "updated@example.com",
    "phone": "+9876543210",
    "is_active": false,
    "password": "newpassword123",
    "role_ids": [2, 3]
}
```

**Request Fields (all optional):**
- `name` (string, max: 255): User's full name
- `email` (email, unique): User's email address
- `password` (string, min: 8): New password
- `phone` (string, max: 20): User's phone number
- `is_active` (boolean): User's active status
- `role_ids` (array): Array of role IDs to assign

**Response (200 OK):**
```json
{
    "success": true,
    "message": "User updated successfully",
    "data": {
        "id": 1,
        "name": "Updated Name",
        "email": "updated@example.com",
        "phone": "+9876543210",
        "is_active": false,
        "email_verified_at": "2026-05-24T12:00:00.000000Z",
        "roles": [
            {
                "id": 2,
                "name": "Manager",
                "slug": "manager",
                "description": "Management level access with oversight capabilities"
            },
            {
                "id": 3,
                "name": "Store Keeper",
                "slug": "store-keeper",
                "description": "Manages inventory and warehouse operations"
            }
        ],
        "created_at": "2026-05-24T12:00:00.000000Z",
        "updated_at": "2026-05-24T13:00:00.000000Z"
    }
}
```

---

### 9. Delete User

Deletes a user from the system.

**Endpoint:** `DELETE /users/{id}`

**Authentication:** Required

**Response (200 OK):**
```json
{
    "success": true,
    "message": "User deleted successfully"
}
```

---

## Available Roles

The system includes the following predefined roles:

1. **Admin** (slug: `admin`)
   - Full system access and administration privileges

2. **Manager** (slug: `manager`)
   - Management level access with oversight capabilities

3. **Store Keeper** (slug: `store-keeper`)
   - Manages inventory and warehouse operations

4. **Sales Staff** (slug: `sales-staff`)
   - Handles sales transactions and customer interactions

5. **Accountant** (slug: `accountant`)
   - Manages financial records and transactions

6. **Read-only Auditor** (slug: `read-only-auditor`)
   - View-only access for auditing purposes

---

## Sample Test Users

The system includes these pre-seeded test users (all with password: `password`):

| Email | Role | Password |
|-------|------|----------|
| admin@inventory.com | Admin | password |
| manager@inventory.com | Manager | password |
| storekeeper@inventory.com | Store Keeper | password |
| sales@inventory.com | Sales Staff | password |
| accountant@inventory.com | Accountant | password |
| auditor@inventory.com | Read-only Auditor | password |

---

## Error Responses

### Validation Error (422 Unprocessable Entity)
```json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": [
            "The email field is required."
        ],
        "password": [
            "The password must be at least 8 characters."
        ]
    }
}
```

### Unauthenticated (401 Unauthorized)
```json
{
    "message": "Unauthenticated."
}
```

### Not Found (404 Not Found)
```json
{
    "message": "Resource not found."
}
```

---

## Testing with cURL

### Login Example
```bash
curl -X POST http://localhost/api/login \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "email": "admin@inventory.com",
    "password": "password"
  }'
```

### Create User Example (with authentication)
```bash
curl -X POST http://localhost/api/users \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -d '{
    "name": "New User",
    "email": "newuser@example.com",
    "password": "password123",
    "role_ids": [3]
  }'
```

### Get User List Example
```bash
curl -X GET "http://localhost/api/users?per_page=10" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

---

## Testing with Postman

1. **Import the API**: Create a new collection in Postman
2. **Set Base URL**: `http://localhost/api`
3. **Login**: Send POST request to `/login` with credentials
4. **Copy Token**: From the response, copy the `access_token`
5. **Set Authorization**: In collection settings, set Authorization type to "Bearer Token" and paste the token
6. **Test Endpoints**: All authenticated endpoints will now work

---

## Notes

- All timestamps are in ISO 8601 format (UTC)
- Pagination is available on list endpoints
- All responses include a `success` boolean field
- Error messages are consistent and descriptive
- Laravel Horizon is not available on Windows due to PCNTL extension requirement
- Redis is configured for cache, queues, and sessions
- API follows RESTful conventions
