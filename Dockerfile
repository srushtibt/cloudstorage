FROM php:8.2-apache

# Optional: copy your PHP files
COPY . /var/www/html/

# Expose the correct port
EXPOSE 80
