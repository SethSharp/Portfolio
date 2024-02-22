#!/bin/bash

cd /var/www/html/

php artisan key:generate

php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

npm run build
