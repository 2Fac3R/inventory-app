# Inventory App

[![Laravel](https://img.shields.io/badge/Laravel-8.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![Vue.js](https://img.shields.io/badge/Vue.js-3.x-4FC08D?style=for-the-badge&logo=vue.js)](https://vuejs.org)
[![Inertia.js](https://img.shields.io/badge/Inertia.js-0.5-9553E9?style=for-the-badge)](https://inertiajs.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css)](https://tailwindcss.com)
[![Docker](https://img.shields.io/badge/Docker-Enabled-2496ED?style=for-the-badge&logo=docker)](https://www.docker.com)

A comprehensive product inventory management system built with Laravel 8, Vue 3, and Inertia.js. This application bridges the backend and frontend seamlessly to provide a modern SPA experience.

## 🚀 Quick Start (Docker)

The fastest way to get the application running is using Docker Compose.

1. **Clone and Enter:**
   ```bash
   git clone https://github.com/2Fac3R/inventory-app.git
   cd inventory-app
   ```

2. **Launch Environment:**
   ```bash
   docker-compose up -d --build
   ```
   *This will automatically install dependencies, set up Nginx, PHP-FPM, MySQL, and run migrations.*

3. **Seed Database:**
   ```bash
   docker-compose exec app php artisan db:seed
   ```

4. **Access:**
   Visit [http://localhost:8000](http://localhost:8000)

---

## 🛠 Manual Installation

If you prefer to run the application locally:

### Prerequisites
- PHP 7.3+ & Composer
- Node.js & npm
- MySQL

### Steps
1. **Install Dependencies:**
   ```bash
   composer install
   npm install
   ```

2. **Configure Environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Edit `.env` to set your database credentials.*

3. **Database Migration & Seeding:**
   ```bash
   php artisan migrate --seed
   ```

4. **Build Assets:**
   ```bash
   npm run dev
   # or
   npm run watch
   ```

5. **Start Server:**
   ```bash
   php artisan serve
   ```

---

## 📖 Usage

- **Dashboard:** `http://localhost:8000/dashboard`
- **Product Management:** `http://localhost:8000/products`
- **Registration:** `http://localhost:8000/register`
- **Login:** `http://localhost:8000/login`

---

## 🧪 Testing

The project includes comprehensive Feature and Unit tests using PHPUnit.

**Local:**
```bash
php artisan test
```

**Docker:**
```bash
docker-compose exec app php artisan test
```

---

## 🤝 Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
