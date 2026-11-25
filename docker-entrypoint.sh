#!/bin/sh
set -e

# Ensure database exists and has correct permissions
mkdir -p /var/www/html/database
touch /var/www/html/database/database.sqlite
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# Generate app key if not provided
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Run database migrations and seed initial books & users
php artisan migrate --force
php artisan db:seed --force

# Optimize caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start Apache in foreground
exec apache2-foreground
