FROM php:8.3-fpm-alpine

# Install dev dependencies
RUN apk update \
    && apk upgrade --available \
    && apk add --no-cache \
        zlib \
        libzip \
        bzip2 \
        libpng \
        libjpeg-turbo \
        libwebp \
        freetype \
        postgresql-libs \
        postgresql-client \
    && apk add --no-cache --virtual .build-deps \
        autoconf \
        build-base \
        icu-dev \
#        libevent-dev \
#        openssl-dev \
        zlib-dev \
        libzip-dev \
        libpng-dev \
        libjpeg-turbo-dev \
        libwebp-dev \
        freetype-dev \
        postgresql-dev \
        linux-headers \
        curl \
        wget \
        bash

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

COPY ./debug.ini /usr/local/etc/php/conf.d/
# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/
RUN docker-php-ext-install -j$(getconf _NPROCESSORS_ONLN) \
#    intl \
#    gd \
#    bcmath \
    pdo_pgsql \
#    sockets \
    zip
#RUN pecl channel-update pecl.php.net \
#    && pecl install -o -f \
#        redis \
#        event \
#    && rm -rf /tmp/pear \
#    && echo "extension=redis.so" > /usr/local/etc/php/conf.d/redis.ini \
#    && echo "extension=event.so" > /usr/local/etc/php/conf.d/event.ini

# Install PHP-XDebug extensions
RUN pecl install xdebug && docker-php-ext-enable xdebug
#ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
#RUN chmod uga+x /usr/local/bin/install-php-extensions && sync
#RUN install-php-extensions xdebug-3.3.1
COPY ./xdebug.ini /usr/local/etc/php/conf.d/
WORKDIR /data/otus.yu/
