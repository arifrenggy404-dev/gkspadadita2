#!/bin/bash

# Jalankan migrasi database
echo "Running migrations..."
php artisan migrate --force

# Jalankan server
echo "Starting server..."
php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
