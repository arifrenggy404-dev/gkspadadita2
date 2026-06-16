FROM php:8.3-cli-alpine

# Install tools dan ekstensi yang diperlukan Laravel
RUN apk add --no-cache git unzip bash libpng-dev libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Menyalin file konfigurasi composer
COPY composer.json composer.lock /app/

# Jalankan Composer Install
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Menyalin seluruh file project
COPY . /app

# Generate autoload
RUN composer dump-autoload --optimize

# Memastikan izin folder storage dan cache
RUN chmod -R 777 /app/storage /app/bootstrap/cache

# Port default
EXPOSE 8080

CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8080}



