# Full Stack To-Do List Application

A modern, real-time To-Do List application built with Laravel backend and Vue.js frontend, featuring JWT authentication, real-time notifications, and a clean modern UI.

## 🚀 Features

- **Authentication System**: JWT-based authentication with registration and login
- **CRUD Operations**: Complete task management (Create, Read, Update, Delete)
- **Real-time Notifications**: Live updates using Pusher WebSockets
- **Modern UI**: Built with Vue.js, Pinia, and Shadcn components
- **Security**: Protected routes with JWT middleware
- **User Isolation**: Users can only access their own tasks
- **Professional Structure**: Following SOLID principles, Service and Repository patterns

## 🛠️ Tech Stack

### Backend
- **Laravel** (PHP Framework)
- **MySQL** Database
- **JWT Authentication** (tymon/jwt-auth)
- **Pusher** for WebSocket broadcasting
- **Service & Repository Pattern**

### Frontend
- **Vue.js 3** (Composition API)
- **Pinia** (State Management)
- **Vue Router** (Navigation)
- **Axios** (HTTP Client)
- **Laravel Echo** + **Pusher-js** (Real-time)
- **Shadcn/ui** (Modern UI Components)
- **Vite** (Build Tool)

## 📋 Prerequisites

Before running this project, make sure you have:

- **PHP >= 8.1**
- **Composer**
- **Node.js >= 16**
- **npm or yarn**
- **MySQL Server**
- **Git**

## 🔧 Installation & Setup

### 1. Clone the Repository

```bash
git clone https://github.com/belguabd/ToDo.git
cd ToDo
```

### 2. Backend Setup (Laravel)

#### Navigate to Backend Directory and Install PHP Dependencies
```bash
cd backend
composer install
```

#### Environment Configuration
```bash
# Copy the environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Generate JWT secret
php artisan jwt:secret
```

#### Configure your `.env` file with the following settings:

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:qEjh5/TO/aZHsYfKp8uovUjVHISp3RgO+7QsUt40vcI=
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=your_password

# JWT Configuration
JWT_SECRET=DilyzdHxqRejH1Bcw2PVi4omz1IFavw156jPiNn92SREy06QViD9m2F91fFKgYjW

# Pusher Configuration
BROADCAST_DRIVER=pusher
PUSHER_APP_ID=2029231
PUSHER_APP_KEY=54d01583daea6c80ca52
PUSHER_APP_SECRET=7efbb9198e5b12ec5105
PUSHER_APP_CLUSTER=mt1
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https

# Session & Cache
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=sync
```

#### Database Setup
```bash
# Create the database (make sure MySQL is running)
mysql -u root -p
CREATE DATABASE laravel_db;
CREATE USER 'laravel_user'@'localhost' IDENTIFIED BY 'your_password';
GRANT ALL PRIVILEGES ON laravel_db.* TO 'laravel_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;

# From the backend directory, run migrations
php artisan migrate

# Optional: Seed the database
php artisan db:seed
```

### 3. Frontend Setup (Vue.js)

#### Navigate to Frontend Directory
```bash
cd frontend
```

#### Install Node Dependencies
```bash
npm install
# or
yarn install
```

#### Configure Frontend Environment
Create a `.env` file in the frontend directory:

```env
VITE_API_BASE_URL=http://localhost:8000/api
VITE_PUSHER_APP_KEY=54d01583daea6c80ca52
VITE_PUSHER_APP_CLUSTER=mt1
VITE_PUSHER_APP_ID=2029231
VITE_PUSHER_APP_SECRET=7efbb9198e5b12ec5105
```

## 🚀 Running the Application

### 1. Start the Backend Server

```bash
# From the backend directory
cd backend
php artisan serve
```
The Laravel API will be available at: `http://localhost:8000`

### 2. Start the Frontend Development Server

```bash
# From the frontend directory
cd frontend
npm run dev
# or
yarn dev
```
The Vue.js application will be available at: `http://localhost:5173`

### 3. Start Queue Worker (for real-time notifications)

```bash
# In a new terminal, from the backend directory
cd backend
php artisan queue:work
```

## 📚 API Documentation

### Authentication Endpoints

#### Register User
```http
POST /api/auth/register
Content-Type: application/json

{
    "name": "John Doe",
    "email": "john@example.com",
    "phone": "+1234567890",
    "address": "123 Main St, City, Country",
    "image": "base64_encoded_image_or_url",
    "password": "password123",
    "password_confirmation": "password123"
}
```

#### Login User
```http
POST /api/auth/login
Content-Type: application/json

{
    "email": "john@example.com",
    "password": "password123"
}
```

#### Logout User
```http
POST /api/auth/logout
Authorization: Bearer {jwt_token}
```

### Task Management Endpoints

#### Get All Tasks
```http
GET /api/tasks
Authorization: Bearer {jwt_token}
```

#### Get Single Task
```http
GET /api/tasks/{id}
Authorization: Bearer {jwt_token}
```

#### Create Task
```http
POST /api/tasks
Authorization: Bearer {jwt_token}
Content-Type: application/json

{
    "title": "Complete project documentation",
    "description": "Write comprehensive README and API docs",
    "status": "pending",
    "due_date": "2024-12-31"
}
```

#### Update Task
```http
PUT /api/tasks/{id}
Authorization: Bearer {jwt_token}
Content-Type: application/json

{
    "title": "Updated task title",
    "description": "Updated description",
    "status": "completed",
    "due_date": "2024-12-31"
}
```

#### Delete Task
```http
DELETE /api/tasks/{id}
Authorization: Bearer {jwt_token}
```

## 🔄 Real-time Features

The application includes real-time notifications using Pusher WebSockets:

- **Task Creation Notifications**: When a user creates a task, other users receive real-time notifications
- **Notification Page**: A dedicated page to view all received notifications
- **Live Updates**: Task lists update in real-time across all connected clients

### WebSocket Events

- `task.created`: Broadcasted when a new task is created
- `task.updated`: Broadcasted when a task is updated
- `task.deleted`: Broadcasted when a task is deleted

## 🏗️ Project Structure

```
ToDo/
├── backend/
│   ├── app/
│   │   ├── Http/
│   │   │   ├── Controllers/
│   │   │   ├── Middleware/
│   │   │   └── Requests/
│   │   ├── Models/
│   │   ├── Services/
│   │   ├── Repositories/
│   │   └── Events/
│   ├── database/
│   │   ├── migrations/
│   │   └── seeders/
│   ├── routes/
│   │   ├── api.php
│   │   └── web.php
│   ├── .env
│   └── composer.json
├── frontend/
│   ├── src/
│   │   ├── components/
│   │   ├── views/
│   │   ├── stores/
│   │   ├── router/
│   │   └── services/
│   ├── .env
│   ├── package.json
│   └── vite.config.js
└── README.md
```

## 🔒 Security Features

- **JWT Authentication**: Secure token-based authentication
- **Route Protection**: API routes protected with JWT middleware
- **User Isolation**: Users can only access their own tasks
- **Input Validation**: Request validation on all endpoints
- **CORS Configuration**: Properly configured for frontend-backend communication

## 🧪 Testing

### Backend Tests
```bash
# From the backend directory
cd backend
php artisan test
```

### Frontend Tests
```bash
# Run Vue.js tests
cd frontend
npm run test
# or
yarn test
```

## 🚀 Deployment

### Backend Deployment (Laravel)

1. Set up your production server with PHP, Composer, and MySQL
2. Clone the repository
3. Install dependencies: `composer install --optimize-autoloader --no-dev`
4. Configure production `.env` file
5. Generate application key: `php artisan key:generate`
6. Run migrations: `php artisan migrate --force`
7. Set up a web server (Apache/Nginx) to serve the application

### Frontend Deployment (Vue.js)

1. Build the production version: `npm run build`
2. Deploy the `dist/` folder to your web server
3. Configure your web server to serve the SPA properly

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch: `git checkout -b feature/amazing-feature`
3. Commit your changes: `git commit -m 'Add some amazing feature'`
4. Push to the branch: `git push origin feature/amazing-feature`
5. Open a Pull Request

## 🆘 Troubleshooting

### Common Issues

#### Database Connection Error
- Ensure MySQL is running
- Check database credentials in `.env`
- Verify database exists and user has proper permissions

#### JWT Token Issues
- Make sure `JWT_SECRET` is set in `.env`
- Run `php artisan jwt:secret` if needed
- Clear application cache: `php artisan cache:clear`

#### Pusher Connection Issues
- Verify Pusher credentials in `.env`
- Check that Pusher app is properly configured
- Ensure queue worker is running for broadcasting

#### Frontend API Connection Issues
- Verify `VITE_API_BASE_URL` in frontend `.env`
- Check that Laravel server is running on correct port
- Ensure CORS is properly configured

### Getting Help

If you encounter any issues:

1. Check the Laravel logs: `backend/storage/logs/laravel.log`
2. Check browser console for frontend errors
3. Verify all environment variables are set correctly
4. Ensure all dependencies are installed

---

**Happy Coding! 🎉**
