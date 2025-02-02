# Laravel Backend Developer Task - BeGroup

## Introduction
This project is a RESTful API for managing tasks using Laravel 10.x. It includes authentication via Laravel Sanctum, CRUD operations, request validation, and optional enhancements like pagination and resource classes.

## Prerequisites
Ensure you have the following installed before setting up the project:

- PHP >= 8.1
- Composer
- Laravel 10.x
- MySQL or PostgreSQL
- Node.js & NPM (if frontend dependencies are needed)

## Installation

1. Clone the repository:

   ```sh
   git clone https://github.com/your-repository.git
   cd your-repository
   ```

2. Install dependencies:

   ```sh
   composer install
   ```

3. Copy the `.env.example` file to `.env`:

   ```sh
   cp .env.example .env
   ```

4. Generate the application key:

   ```sh
   php artisan key:generate
   ```

5. Set up the database in `.env`:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. Run database migrations and seed initial data:

   ```sh
   php artisan migrate:fresh --seed
   ```

7. Install Laravel Sanctum and publish configurations:

   ```sh
   php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
   ```

8. Serve the application:

   ```sh
   php artisan serve
   ```

The API will now be available at `http://127.0.0.1:8000/api`.

---

## Authentication

This project uses Laravel Sanctum for authentication. To get an authentication token:

1. Register a new user:

   ```sh
   POST /api/register
   ```

2. Log in to obtain a token:

   ```sh
   POST /api/login
   ```

Use the returned token in the `Authorization` header for protected routes:

   ```sh
   Authorization: Bearer YOUR_ACCESS_TOKEN
   ```

---

## API Documentation

The API is documented using Postman. You can access the full API documentation here:

🔗 [API Documentation](https://documenter.getpostman.com/view/20112660/2sAYX3rNx3)

---

## CRUD Endpoints

| Method | Endpoint         | Description                 | Auth Required |
|--------|-----------------|-----------------------------|--------------|
| `GET`  | `/api/tasks`    | Get all tasks               | ✅ |
| `GET`  | `/api/tasks/{id}` | Get a single task by ID   | ✅ |
| `POST` | `/api/tasks`    | Create a new task           | ✅ |
| `PUT`  | `/api/tasks/{id}` | Update a task by ID       | ✅ |
| `DELETE` | `/api/tasks/{id}` | Soft delete a task       | ✅ |

**Example Task Object:**
```json
{
  "id": 1,
  "name": "Sample Task",
  "description": "This is a sample task",
  "status": "pending",
  "created_at": "2024-02-02T10:00:00Z",
  "updated_at": "2024-02-02T10:30:00Z"
}
```

---

## Running Tests

To run tests:

```sh
php artisan test
```

---

## Additional Features

- Pagination support for task listing.
- Laravel Resource Classes for structured API responses.
- Proper validation on all endpoints.
- Soft delete implementation for better data management.

---

## Deployment

1. Configure the `.env` file for production.
2. Run migrations:

   ```sh
   php artisan migrate --force
   ```

3. Optimize for performance:

   ```sh
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

4. Restart the server.

---

## License

This project is licensed under the MIT License.

---

## Contact

For any questions or contributions, feel free to contact me.

