# Use official PHP image with Apache
FROM php:8.2-apache

# Install PostgreSQL extension
RUN apt-get update && apt-get install -y \
        libpq-dev \
    && docker-php-ext-install pgsql pdo_pgsql \
    && apt-get clean

# Copy source code into the container
COPY . /var/www/html/

# Expose port 80 (Apache default)
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
