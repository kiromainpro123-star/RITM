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
    autoconf \
    oniguruma-dev

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

# Create .env from .env.example and prepare SQLite database
RUN cp .env.example .env
RUN touch database/database.sqlite

# Install dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Install npm packages if needed
RUN if [ -f package.json ]; then npm install; fi

# Generate APP_KEY and run migrations
RUN php artisan key:generate --force
RUN php artisan migrate --force

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port
EXPOSE 8000

# Start command
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
