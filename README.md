# inventory-app
## Description

This project implements a product inventory system. A complete system has been developed, encompassing the backend, its functionalities, and corresponding tests. The frontend portion is built with Vue.js, utilizing Inertia.js to seamlessly connect with Laravel, complemented by the styling prowess of TailwindCSS.

Stack:

* PHP (7.3) + Laravel (8)
* Inertia.js: Build single-page apps, without building an API
* Vue.js: The Progressive JavaScript Framework
* HTML + CSS (TailwindCSS Framework)


## Installation

Clone the repository

    git clone https://github.com/2Fac3R/inventory-app.git

Switch to the repo folder

    cd inventory-app

Install all the dependencies using composer

    composer install

Rename ".env.example" to ".env" and add your database settings.
    
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=<your-database>
    DB_USERNAME=<your-username>
    DB_PASSWORD=<your-password>

Run migrations

    php artisan migrate

Run seeder

    php artisan db:seed

This will run the following code

    \App\Models\User::factory(3)->create();  // Creates 3 users
    \App\Models\Category::factory(10)->create();  // Creates 10 categories
    \App\Models\Product::factory(200)->create();  // Creates 200 products

Start the local development server

    php artisan serve

## Usage

Log in or create a new user, user profile settings...

    http://127.0.0.1:8000/dashboard
    http://127.0.0.1:8000/register
    http://127.0.0.1:8000/login

List of products

    http://127.0.0.1:8000/products

Create a new product

    http://127.0.0.1:8000/products/create

Get a product by id

    http://127.0.0.1:8000/products/{id}>

Edit a product by id

    http://127.0.0.1:8000/products/{id}/edit>


## Frontend with Vue.js

If you wish to make changes in vue code, first install dependencies with npm and run dev.

    npm install
    npm run dev

Keep the server running for changes.

    npm run watch


## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Any feedback is appreciated.
