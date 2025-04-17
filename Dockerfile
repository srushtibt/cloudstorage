FROM php:8.2-apache

# Install MySQL extensions for PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY . /var/www/html/
