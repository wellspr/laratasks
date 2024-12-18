#Dockerfile Example on running PHP Laravel app using Apache web server

FROM php:8.3-apache

# Install necessary libraries
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    libpq-dev

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql

RUN docker-php-ext-install pdo pdo_pgsql pgsql

# Install PHP extensions
RUN docker-php-ext-install \
    mbstring \
    zip

# Copy Laravel application
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install dependencies
RUN composer install

# Change ownership of our applications
RUN chown -R www-data:www-data /var/www/html

RUN docker-php-ext-install mbstring

COPY .env.docker .env
RUN php artisan key:generate
RUN php artisan migrate

# Expose port 80
EXPOSE 80

# Adjusting Apache configurations
RUN a2enmod rewrite
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf
