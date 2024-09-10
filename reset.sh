#!/bin/bash


find storage/app/public/* ! -name '.gitignore' -delete

php artisan migrate:fresh --seed

php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

php artisan storage:link

echo "Reset Laravel project selesai!"
