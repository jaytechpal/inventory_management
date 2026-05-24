# Inventory Management Frontend

Modern React + TypeScript frontend application for the Inventory Management System, built with enterprise-grade tools and best practices for scalability.

## Tech Stack

### Core
- **React 18.3.1** - UI library
- **TypeScript 5.5.3** - Type safety
- **Vite 5.3.4** - Build tool and dev server

### State Management & Data Fetching
- **TanStack Query (React Query) 5.51.1** - Server state management
- **Zustand 4.5.4** - Client state management

### Routing
- **React Router DOM 6.26.0** - Client-side routing

### Forms & Validation
- **React Hook Form 7.52.1** - Form management
- **Zod 3.23.8** - Schema validation
- **@hookform/resolvers** - Form validation integration

### Styling
- **Tailwind CSS 3.4.6** - Utility-first CSS framework
- **PostCSS** - CSS processing
- **Autoprefixer** - CSS vendor prefixing

### HTTP Client
- **Axios 1.7.2** - API requests with interceptors

### UI Components & Icons
- **Lucide React** - Icon library
- **Sonner** - Toast notifications
- **clsx** & **tailwind-merge** - Conditional class merging

## Project Structure

```
frontend/
├── public/                 # Static assets
├── src/
│   ├── api/               # API client and endpoints
│   │   ├── client.ts      # Axios instance with interceptors
│   │   └── auth.ts        # Authentication API calls
│   ├── components/        # Reusable components
│   │   └── ProtectedRoute.tsx
│   ├── lib/              # Library configurations
│   │   └── queryClient.ts # React Query setup
│   ├── pages/            # Page components
│   │   ├── Login.tsx     # Login page
│   │   └── Dashboard.tsx # Dashboard page
│   ├── store/            # Zustand stores
│   │   └── authStore.ts  # Authentication state
│   ├── types/            # TypeScript types
│   │   └── auth.ts       # Auth-related types
│   ├── utils/            # Utility functions
│   │   └── cn.ts         # Class name utility
│   ├── App.tsx           # Main app component with routing
│   ├── main.tsx          # Application entry point
│   └── index.css         # Global styles with Tailwind
├── .env                  # Environment variables
├── .env.example          # Environment variables template
├── tailwind.config.js    # Tailwind configuration
├── postcss.config.js     # PostCSS configuration
├── vite.config.ts        # Vite configuration
├── tsconfig.json         # TypeScript configuration
├── tsconfig.app.json     # App TypeScript configuration
└── package.json          # Dependencies and scripts
```

## Getting Started

### Prerequisites
- Node.js 18+ installed
- Backend API running on `http://localhost:8000`

### Installation

1. Install dependencies:
   ```bash
   npm install
   ```

2. Create environment file:
   ```bash
   cp .env.example .env
   ```

3. Update `.env` with your API URL:
   ```
   VITE_API_BASE_URL=http://localhost:8000
   ```

### Development

Start the development server:
```bash
npm run dev
```

The app will open at `http://localhost:5173`

### Build for Production

```bash
npm run build
```

Preview production build:
```bash
npm run preview
```

## Features Implemented

### ✅ Authentication
- Login page with form validation
- Token-based authentication (Bearer tokens)
- Auto token storage and injection
- Protected routes
- Auto redirect on 401 errors

### ✅ Dashboard
- User profile display with roles
- Statistics cards (mock data)
- Feature grid
- Logout functionality
- Real-time user data fetch

### ✅ State Management
- Zustand for auth state (user, token)
- React Query for API data fetching
- Persistent state (localStorage)

### ✅ Form Handling
- React Hook Form integration
- Zod schema validation
- Error display
- Loading states

### ✅ UI/UX
- Responsive design (mobile-first)
- Modern Tailwind UI
- Toast notifications
- Loading indicators
- Gradient backgrounds
- Icon integration

## API Integration

The frontend connects to the Laravel backend API:

### Base URL
`http://localhost:8000/api`

### Authentication Endpoints
- `POST /login` - User login
- `POST /register` - User registration
- `POST /logout` - User logout
- `GET /me` - Get current user

### Request Headers
```javascript
{
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
```

## Code Patterns

### API Calls with React Query
```typescript
const { data, isLoading, error } = useQuery({
  queryKey: ['me'],
  queryFn: authApi.me,
});
```

### Mutations
```typescript
const mutation = useMutation({
  mutationFn: authApi.login,
  onSuccess: (data) => {
    // Handle success
  },
  onError: (error) => {
    // Handle error
  },
});
```

### Form Validation
```typescript
const schema = z.object({
  email: z.string().email('Invalid email'),
  password: z.string().min(8, 'Min 8 characters'),
});

const { register, handleSubmit, formState: { errors } } = useForm({
  resolver: zodResolver(schema),
});
```

### Protected Routes
```typescript
<Route
  path="/dashboard"
  element={
    <ProtectedRoute>
      <Dashboard />
    </ProtectedRoute>
  }
/>
```

## Environment Variables

| Variable | Description | Default |
|----------|-------------|---------|
| `VITE_API_BASE_URL` | Backend API base URL | `http://localhost:8000` |

## Test Credentials

Use these credentials to test the application:

- **Email:** admin@inventory.com
- **Password:** password

## Development Tools

- **React Query Devtools** - Available in development mode (bottom-left corner)
- **Vite HMR** - Fast hot module replacement
- **TypeScript** - Full type checking

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## Scalability Features

### Code Organization
- Modular folder structure
- Separation of concerns
- Type-safe API calls

### State Management
- Centralized stores
- Optimistic updates support
- Cache invalidation

### Performance
- Code splitting ready
- Lazy loading support
- React Query caching

### Maintainability
- TypeScript for type safety
- Consistent code patterns
- Utility functions

## Next Steps

1. Add more pages (users, products, orders)
2. Implement role-based UI rendering
3. Add form validations for more endpoints
4. Create reusable UI components
5. Add unit tests
6. Add E2E tests
7. Implement error boundaries
8. Add loading skeletons

## Scripts

- `npm run dev` - Start development server
- `npm run build` - Build for production
- `npm run preview` - Preview production build
- `npm run lint` - Run ESLint

## License

Private - Inventory Management System
