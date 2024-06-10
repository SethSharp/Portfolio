#!/bin/bash

cd /var/www/html/ || { echo "Failed to change directory to /var/www/html/"; exit 1; }

php artisan cache:clear
php artisan config:cache
php artisan view:cache
php artisan route:cache

echo "yes" | php artisan migrate --force || { echo "Failed to run migrations"; exit 1; }

echo "yes" | php artisan bootstrap || { echo "Failed to run bootstrap commands"; exit 1; }
