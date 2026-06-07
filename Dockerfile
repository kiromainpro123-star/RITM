FROM php:8.1-fpm-alpine

WORKDIR /var/www/html

# Install system dependencies
RUN apk add --no-cache \
    curl \
    git \
    zip \
    unzip \
    npm \
    alpine-sdk \
    autoconf

# Install PHP extensions
RUN docker-php-ext-install -j$(nproc) \
    pdo \
    pdo_mysql \
    bcmath \
    mbstring

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application code
COPY . .

# Install dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Install npm packages if needed
RUN if [ -f package.json ]; then npm install && npm run build; fi

# Generate APP_KEY if not set
RUN php artisan key:generate --force || true

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port
EXPOSE 8000

# Start command
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
