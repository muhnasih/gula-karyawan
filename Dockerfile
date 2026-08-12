FROM php:8.2-apache

# =========================================================
# Install dependencies & PHP extensions
# =========================================================
RUN apt-get update && apt-get install -y \
        git \
        unzip \
        libzip-dev \
        libpng-dev \
        libjpeg62-turbo-dev \
        libfreetype6-dev \
        libonig-dev \
        libxml2-dev \
        curl \
        nodejs \
        npm \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
    && docker-php-ext-install \
        gd \
        pdo \
        pdo_mysql \
        mbstring \
        xml \
        zip \
        bcmath \
        opcache \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# =========================================================
# Apache MPM
# Pastikan HANYA mpm_prefork aktif
# =========================================================
RUN a2dismod mpm_event mpm_worker mpm_prefork || true \
    && rm -f /etc/apache2/mods-enabled/mpm_*.load \
             /etc/apache2/mods-enabled/mpm_*.conf \
    && a2enmod mpm_prefork \
    && a2enmod rewrite \
    && echo "=== APACHE MPM CHECK ===" \
    && apache2ctl -M | grep mpm

# =========================================================
# Working directory
# =========================================================
WORKDIR /var/www/html

# =========================================================
# Composer
# =========================================================
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# =========================================================
# Copy Laravel project
# =========================================================
COPY . .

# =========================================================
# Install Composer dependencies
# =========================================================
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction

# =========================================================
# Install frontend dependencies
# =========================================================
RUN npm install

# =========================================================
# Build Vite
# =========================================================
RUN npm run build

# =========================================================
# Laravel permissions
# =========================================================
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# =========================================================
# Apache DocumentRoot
# =========================================================
RUN sed -i \
    's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' \
    /etc/apache2/sites-available/000-default.conf

# =========================================================
# Laravel Apache configuration
# =========================================================
RUN printf '%s\n' \
    '<Directory /var/www/html/public>' \
    '    AllowOverride All' \
    '    Require all granted' \
    '</Directory>' \
    > /etc/apache2/conf-available/laravel.conf

RUN a2enconf laravel

# =========================================================
# Railway PORT
# =========================================================
RUN printf '%s\n' \
    '#!/bin/sh' \
    'set -e' \
    'PORT=${PORT:-8080}' \
    'sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf' \
    'sed -i "s/:80>/:${PORT}>/" /etc/apache2/sites-available/000-default.conf' \
    'echo "=== FINAL APACHE MPM CHECK ==="' \
    'apache2ctl -M | grep mpm' \
    'echo "=== STARTING APACHE ==="' \
    'exec apache2-foreground' \
    > /usr/local/bin/start-laravel.sh

RUN chmod +x /usr/local/bin/start-laravel.sh

# =========================================================
# Start
# =========================================================
CMD ["/usr/local/bin/start-laravel.sh"]