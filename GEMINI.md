# GEMINI.md - Inventory App Instructional Context

This document provides foundational context and instructions for AI-assisted development of the `inventory-app`.

## Project Overview

The **Inventory App** is a product inventory management system built with the Laravel ecosystem. It features a full-stack architecture that bridges the backend and frontend using Inertia.js, allowing for a single-page application (SPA) experience without the complexity of a separate API.

- **Backend:** Laravel 8 (PHP 7.3+)
- **Frontend:** Vue 3, Inertia.js
- **Styling:** Tailwind CSS
- **Authentication:** Laravel Breeze / Sanctum
- **Database:** MySQL (configured via `.env`)

### Domain Models
- **Product:** Manages inventory items with attributes: `sku`, `name`, `description`, `price`, `quantity`, `state`, and `category_id`.
- **Category:** Organizes products into groups.

## Building and Running

### Prerequisites
- PHP 7.3+
- Composer
- Node.js & npm

### Setup
1. **Install PHP Dependencies:**
   ```bash
   composer install
   ```
2. **Install JS Dependencies:**
   ```bash
   npm install
   ```
3. **Environment Configuration:**
   - Copy `.env.example` to `.env`.
   - Configure your database settings in `.env`.
   - Generate application key:
     ```bash
     php artisan key_generate
     ```
4. **Database Setup:**
   - Run migrations and seeders:
     ```bash
     php artisan migrate --seed
     ```
5. **Compile Assets:**
   - For development:
     ```bash
     npm run dev
     ```
   - For continuous compilation:
     ```bash
     npm run watch
     ```

### Running the Application
Start the local development server:
```bash
php artisan serve
```
Access the application at `http://localhost:8000`.

## Docker Usage

The application can be run using Docker Compose, which sets up PHP-FPM, Nginx, and MySQL automatically.

### Commands
- **Start the environment:**
  ```bash
  docker-compose up -d --build
  ```
- **Seed the database:**
  ```bash
  docker-compose exec app php artisan db:seed
  ```
- **Run tests inside Docker:**
  ```bash
  docker-compose exec app php artisan test
  ```
- **Stop the environment:**
  ```bash
  docker-compose down
  ```

### Accessing the App
When running via Docker, the application is accessible at `http://localhost:8000`.
The database is available on port `3306` with the credentials defined in `docker-compose.yml`.

## Testing
The project uses PHPUnit for feature and unit testing.

- **Run all tests:**
  ```bash
  php artisan test
  ```
- **Feature Tests:** Located in `tests/Feature/`. These focus on controller logic and routing.
- **Unit Tests:** Located in `tests/Unit/`. These focus on model relationships and isolated logic.

## Development Conventions

- **Inertia.js Integration:** Controllers should return `Inertia::render('PageName', $data)` instead of standard Blade views.
- **Vue Components:** Frontend pages are located in `resources/js/Pages/` and shared components in `resources/js/Components/`.
- **Styling:** Use Tailwind CSS utility classes directly within Vue components.
- **Validation:** Utilize Form Request classes (located in `app/Http/Requests/`) for validating incoming data in controllers.
- **Routing:** Define resource routes for models in `routes/web.php` where applicable.
- **Eloquent Standards:** Always define relationships in models (`app/Models/`) and use factories/seeders for test data generation.

## Key Files
- `routes/web.php`: Core application routing.
- `app/Http/Controllers/ProductController.php`: Main logic for product management.
- `resources/js/Pages/Products/`: Vue pages for product CRUD.
- `database/migrations/`: Database schema definitions.
