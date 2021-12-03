# Установка образа php-fpm
FROM php:7.4-fpm

# Установка системных зависимостей
RUN apt-get update && apt-get install -y git && pecl install xdebug && docker-php-ext-enable xdebug

# Установка расширений PHP (PDO)
RUN docker-php-ext-install pdo_mysql

# Установка архиватора
RUN apt-get update && apt-get install -y zip && apt-get install -y unzip

# Установка composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Рабочая директория
WORKDIR /var/www/html
