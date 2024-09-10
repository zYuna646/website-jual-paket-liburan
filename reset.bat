@echo off


del /Q storage\app\public\*.* > nul
echo.>storage\app\public\.gitignore

php artisan migrate:fresh --seed

php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo Proses reset selesai!
pause
