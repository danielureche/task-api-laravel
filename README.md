# Task Management API

A robust task management REST API built with Laravel, featuring token-based authentication using Laravel Sanctum. This application provides complete CRUD operations for task management with secure user authentication.

## Features

-   **Token-based Authentication** using Laravel Sanctum
-   **Complete CRUD Operations** for tasks (Create, Read, Update, Delete)
-   **RESTful API Design** following Laravel best practices
-   **Secure API Endpoints** with middleware protection
-   **JSON API Responses** with proper HTTP status codes
-   **Input Validation** for all endpoints
-   **Database Migrations** for easy setup

## Requirements

-   PHP >= 8.1
-   Composer
-   MySQL / PostgreSQL / SQLite
-   Laravel >= 10.x

## Installation

1. **Clone the repository**

    ```bash
    git clone <repository-url>
    cd task-management-api
    ```

2. **Setup environment**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

3. **Configure database in `.env` and run migrations**
    ```bash
    php artisan migrate
    php artisan serve
    ```

## API Endpoints

### Authentication

-   `POST /api/register` – Register new user
-   `POST /api/login` – Login user (returns token)
-   `POST /api/logout` – Logout user

### Tasks (requires authentication)

-   `GET /api/tasks` – Get all tasks
-   `GET /api/tasks/{id}` – Get single task
-   `POST /api/tasks` – Create task
-   `PATCH /api/tasks/{id}` – Update task
-   `DELETE /api/tasks/{id}` – Delete task

## Usage

1. Register or login to get an **authentication token**.
2. Include the token in the `Authorization` header for requests:
    ```
    Authorization: Bearer {token}
    ```
3. Use the available API endpoints to create and manage tasks.
