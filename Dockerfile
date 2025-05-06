FROM php:8.4-rc-cli-alpine

# Install dependencies
RUN apk add --no-cache \
    bash \
    git \
    curl \
    unzip

# Set working directory
WORKDIR /var/www

# Copy composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy app files
COPY . .

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Laravel permissions
RUN chmod -R 775 storage bootstrap/cache

# Expose port
EXPOSE 8000

# Start Laravel dev server
CMD php artisan serve --host=0.0.0.0 --port=8000
