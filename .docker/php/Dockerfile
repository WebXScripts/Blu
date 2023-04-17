FROM php:8.2-fpm

# Install system dependencies

ENV UNIX_USER=1000

RUN apt-get update && apt-get install -y \
    cron \
    git \
    gzip \
    libzip-dev \
    zip \
    exif

# create user owner
RUN useradd -u ${UNIX_USER} owner
RUN chsh -s /bin/bash owner

# Set working directory
WORKDIR /var/www/html

RUN sed -i -e 's/www-data/owner/g' /usr/local/etc/php-fpm.d/www.conf

# install composer
RUN curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php
RUN php /tmp/composer-setup.php --install-dir=/bin/ --filename=composer
RUN rm /tmp/composer-setup.php

RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-enable pdo_mysql
RUN docker-php-ext-enable sodium
RUN docker-php-ext-configure exif
RUN docker-php-ext-install exif
RUN docker-php-ext-enable exif
RUN docker-php-ext-install zip
RUN docker-php-ext-enable zip

# php ext gd
RUN apt-get install -y libfreetype6-dev
RUN apt-get install -y libjpeg62-turbo-dev
RUN apt-get install -y libpng-dev
RUN docker-php-ext-configure gd --with-jpeg=/usr/include/ --with-freetype=/usr/include/
RUN docker-php-ext-install gd
RUN docker-php-ext-install gd
RUN docker-php-ext-enable gd

#imagick
RUN apt-get install -y libmagickwand-dev --no-install-recommends
RUN pecl install imagick
RUN docker-php-ext-enable imagick

USER owner

EXPOSE 9000
CMD ["php-fpm"]
