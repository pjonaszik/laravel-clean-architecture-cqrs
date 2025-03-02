# Use the PHP 8.4 FPM base image
FROM php:8.4-fpm

RUN apt-get -y update \
    && apt-get install -y \
        libssl-dev \
        libpq-dev \
        pkg-config \
        libzip-dev \
        libgmp-dev \
        libssl-dev \
        pkg-config \
        libicu-dev \
        unzip \
        git \
        software-properties-common \
        curl

# Install PHP extensions
RUN docker-php-ext-install zip gmp intl\
    && docker-php-ext-enable zip gmp intl opcache

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory
WORKDIR /var/www/html

# Copy the application code into the container
COPY ./src/ /var/www/html/

# Copy the application php config into the container
COPY config/php/docker-php-ext.ini /usr/local/etc/php/conf.d/docker-php-ext.ini

# Install PHP dependencies using Composer
RUN composer install --optimize-autoloader

# Set permissions for the Laravel app
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start the PHP-FPM server
CMD ["php-fpm"]