FROM composer:2.2 AS composer

FROM php:8.1-apache
ARG USER
ARG UPLOAD
ENV APACHE_DOCUMENT_ROOT /var/www/public
RUN apt-get update && apt-get install -y \
        unzip \
        git \
        zip \
        nano \
        curl \
        zlib1g-dev \
        libzip-dev \
        libxml2-dev \
        libpng-dev \
        gnupg2 \
    && docker-php-ext-install -j$(nproc) zip sockets pdo pdo_mysql mysqli dom gd intl \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY --from=composer /usr/bin/composer /usr/bin/composer
WORKDIR /var/www
RUN a2enmod rewrite
RUN echo "export APACHE_DOCUMENT_ROOT=/var/www/public" >> /etc/apache2/envvars
RUN sed -ri -e 's/\/var\/www\/html/${APACHE_DOCUMENT_ROOT}/g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's/\/var\/www/${APACHE_DOCUMENT_ROOT}/g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
RUN sed -ri -e 's/upload_max_filesize = 2M/upload_max_filesize = ${UPLOAD}M/g' /usr/local/etc/php/php.ini
RUN sed -ri -e 's/memory_limit = 128M/memory_limit = 256M/g' /usr/local/etc/php/php.ini
RUN sed -ri -e 's/post_max_size = 8M/post_max_size = ${UPLOAD}M/g' /usr/local/etc/php/php.ini
RUN mkdir -p /var/www/storage/logs/
RUN useradd ${USER}
#RUN php artisan storage:link
#RUN mkdir /home/${USER} && mkdir /home/${USER}/.config && chmod -R 777 /home/${USER}/.config
USER ${USER}
