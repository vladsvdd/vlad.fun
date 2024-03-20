FROM php:7.4-apache

# Установка Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Обновление Composer
RUN composer self-update --2

# Install zip and unzip
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
 && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /var/www/html

# Copy application source
COPY . .

# Install dependencies
RUN composer install

# Install any additional extensions
RUN docker-php-ext-install pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80
