#!/bin/bash

cd /var/www/html/ || { echo "Failed to change directory to /var/www/html/"; exit 1; }

php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
