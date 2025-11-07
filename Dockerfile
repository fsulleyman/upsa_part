# Use official PHP image with Apache
FROM php:8.2-apache

# Copy source code into the container
COPY . /var/www/html/

# Expose port 10000 (optional; for Render use default 10000)
EXPOSE 10000

# Start Apache in the foreground
CMD ["apache2-foreground"]
