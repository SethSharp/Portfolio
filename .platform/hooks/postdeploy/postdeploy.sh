#!/bin/bash

cd /var/www/html/

php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

echo "yes" | php artisan migrate --force
