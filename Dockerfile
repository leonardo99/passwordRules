FROM alpine:latest

WORKDIR /var/www/html

RUN echo "America/Sao_Paulo" > /etc/timezone
RUN apk add --no-cache zip unzip curl sqlite nginx supervisor

RUN apk add bash
RUN sed -i 's/bin\/ash/bin\/bash/g' /etc/passwd

RUN apk add --no-cache php8 \
    php8-common \
    php8-fpm \
    php8-pdo \
    php8-opcache \
    php8-zip \
    php8-phar \
    php8-iconv \
    php8-cli \
    php8-curl \
    php8-openssl \
    php8-mbstring \
    php8-tokenizer \
    php8-fileinfo \
    php8-json \
    php8-xml \
    php8-xmlwriter \
    php8-simplexml \
    php8-dom \
    php8-pdo_mysql \
    php8-pdo_sqlite \
    php8-tokenizer \
    php8-pecl-redis

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm -rf composer-setup.php

RUN mkdir -p /etc/supervisor.d/
COPY .docker/supervisor.ini /etc/supervisor.d/supervisor.ini

RUN mkdir -p /run/php/
RUN touch /run/php/php8.0-fpm.pid

COPY .docker/php.ini-production /etc/php8/php.ini
COPY .docker/php-fpm.conf /etc/php8/php-fpm.conf

COPY .docker/nginx.conf /etc/nginx/
COPY docker/nginx-laravel.conf /etc/nginx/modules/

RUN mkdir -p /run/nginx/
RUN touch /run/nginx/nginx.pid

RUN ln -sf /dev/stdout /var/log/nginx/access.log
RUN ln -sf /dev/stderr /var/log/nginx/error.log

COPY . .
RUN composer install --no-dev

EXPOSE 80
CMD ["supervisord", "-c", "/etc/supervisor.d/supervisord.ini"]



