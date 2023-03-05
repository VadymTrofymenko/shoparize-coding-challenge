FROM php:8.2-fpm

# Install required PHP extensions
RUN apt-get update && apt-get install -y \
    && pecl install redis \
    && docker-php-ext-enable redis


# Copy Nginx configuration
COPY ../.. .

# Set working directory
WORKDIR /var/www/html

# Expose ports
EXPOSE 80

# Start PHP-FPM
CMD ["php-fpm"]

