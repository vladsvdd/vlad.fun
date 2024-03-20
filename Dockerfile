FROM php:7.4-apache

# Install any additional extensions
RUN docker-php-ext-install pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy application source
COPY . /var/www/html/

# Expose port 80
EXPOSE 80