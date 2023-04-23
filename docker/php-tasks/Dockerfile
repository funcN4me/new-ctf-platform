FROM php:7.4.29-fpm

RUN sed -i 's/:9000/:1338/' /usr/local/etc/php-fpm.d/zz-docker.conf

RUN docker-php-ext-install pdo mysqli pdo_mysql

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y \
     git \
     curl \
     zip \
     vim \
     unzip
