FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libssl-dev \
    pkg-config

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo_mysql mbstring exif pcntl bcmath gd

# Install MongoDB extension
RUN pecl install mongodb && docker-php-ext-enable mongodb

# Install Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Enable Apache rewrite module
RUN a2enmod rewrite

# Allow .htaccess overrides
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install composer dependencies fresh from composer.json
RUN composer update --no-interaction --optimize-autoloader --ignore-platform-reqs

# Set permissions for Apache
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80
