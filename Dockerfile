FROM php:8.0-apache
RUN docker-php-ext-install pdo pdo_mysql && docker-php-ext-enable pdo pdo_mysql
RUN apt-get update && apt-get upgrade -y
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer