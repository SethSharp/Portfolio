#!/bin/bash

cd /var/www/html/

sudo su
sudo chmod -R 775 storage

php artisan migrate:fresh --force

php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
php artisan config:cache
