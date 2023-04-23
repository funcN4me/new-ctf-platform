FROM php:7.4-fpm

COPY docker/php/php.ini /usr/local/etc/php/

RUN apt-get update && apt-get install -y \
            libfreetype6-dev \
            libjpeg62-turbo-dev \
            libpng-dev \
            libpq-dev \
            zip \
            git \
            iputils-ping \
            libc-client-dev \
            libkrb5-dev \
            libzip-dev


RUN docker-php-ext-configure pdo_mysql && docker-php-ext-install pdo_mysql
RUN docker-php-ext-configure mysqli && docker-php-ext-install mysqli
RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl && docker-php-ext-install imap
RUN docker-php-ext-configure gd && docker-php-ext-install gd
RUN docker-php-ext-configure zip && docker-php-ext-install zip


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer
