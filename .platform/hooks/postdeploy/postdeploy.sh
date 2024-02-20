#!/bin/bash

sudo su
cd /var/app/current

echo 'Giving permission to storage'
sudo chmod -R 775 storage

echo 'Running migrations'
php artisan migrate:fresh --force

echo 'Composer dump-autoload'
composer dump-autoload

echo 'Clearing cache'
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
php artisan config:cache
