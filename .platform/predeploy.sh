#!/bin/bash

cd /var/www/html

composer dump-autoload

php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
php artisan config:cache

npm run build
