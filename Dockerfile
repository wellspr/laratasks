#Dockerfile Example on running PHP Laravel app using Apache web server


# --> https://stackoverflow.com/a/63108753/11704817 (Showed how to use node docker image directly)
FROM node:latest AS node
FROM php:8.3-apache

COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=node /usr/local/bin/node /usr/local/bin/node
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

# Install necessary libraries
RUN apt-get update && apt-get install -y \
libonig-dev \
libzip-dev

# --> https://github.com/docker-library/php/issues/221#issuecomment-254153971 (Solved how to add postgres support)
RUN apt-get install -y libpq-dev

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

# uncomment next line to run locally
COPY .env .env
#COPY .env.example .env

RUN php artisan key:generate
#RUN php artisan migrate
RUN php artisan optimize

RUN node --version
RUN npm --version
RUN npm install
RUN npm run build

# Expose port 80
EXPOSE 80

# Adjusting Apache configurations
RUN a2enmod rewrite
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf
