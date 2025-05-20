#!/bin/bash

echo "Clearing Laravel caches..."

php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
php artisan event:clear
php artisan optimize:clear

echo "Rebuilding Laravel caches..."

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

echo "✅ All caches cleared and rebuilt successfully."
