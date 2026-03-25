#!/bin/sh

# Install composer dependencies
if [ ! -d "vendor" ]; then
    composer install --no-interaction --no-progress
fi

# Ensure .env exists
if [ ! -f ".env" ]; then
    cp .env.example .env
fi

# Generate app key if not set
if [ -z "$(grep APP_KEY .env | cut -d '=' -f 2)" ]; then
    php artisan key:generate --no-interaction
fi

# Wait for DB to be ready (optional but good)
# sleep 5

# Ensure storage and bootstrap/cache are writable
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Run migrations
php artisan migrate --force

# Execute the main command (passed from Docker CMD)
exec "$@"
