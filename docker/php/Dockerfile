FROM php:8-fpm-alpine

WORKDIR /var/www

RUN apk --no-cache add --virtual .build-deps $PHPIZE_DEPS && docker-php-ext-install mysqli pdo pdo_mysql

# RUN apk --no-cache add --virtual .build-deps $PHPIZE_DEPS && pecl install xdebug-3.1.0 && docker-php-ext-enable xdebug

COPY composer.json ./

RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

RUN composer install --no-dev --no-scripts --no-autoloader --no-interaction

COPY . .

RUN composer dump-autoload --optimize

RUN chown -R www-data:www-data /var/www
