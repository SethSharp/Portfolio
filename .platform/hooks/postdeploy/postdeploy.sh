#!/bin/bash

cd /var/www/html/ || { echo "Failed to change directory to /var/www/html/"; exit 1; }

php artisan cache:clear
php artisan config:cache
php artisan view:cache
php artisan route:cache

echo "yes" | php artisan migrate --force || { echo "Failed to run migrations"; exit 1; }

echo "yes" | php artisan bootstrap || { echo "Failed to run bootstrap commands"; exit 1; }

echo "yes" | php artisan fix:things --slug=grass-roots-contextually-based-ability --time=2024-03-05 || { echo "Failed to run fix:things commands for blog 1"; exit 1; }
echo "yes" | php artisan fix:things --slug=a-day-in-the-life-peer-mentoring-at-griffith-university --time=2024-02-26 || { echo "Failed to run fix:things commands for blog 1"; exit 1; }
