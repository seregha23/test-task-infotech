FROM php:8.0-fpm

RUN apt-get update -y \
    && apt-get install -y nginx \
    && apt install -y zlib1g-dev libpng-dev  \
    && apt-get install libicu-dev -y \
	&& apt-get install libfreetype-dev -y \
	&& apt-get install libjpeg62-turbo-dev -y \
	&& apt-get install libpng-dev -y \
    && apt-get install -y libzip-dev

RUN docker-php-ext-install pdo_mysql \
    && docker-php-ext-install opcache \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install exif \
    && docker-php-ext-install zip \
    && docker-php-ext-install bcmath \
    && apt-get remove libicu-dev icu-devtools -y
RUN { \
        echo 'opcache.memory_consumption=128'; \
        echo 'opcache.interned_strings_buffer=8'; \
        echo 'opcache.max_accelerated_files=4000'; \
        echo 'opcache.revalidate_freq=2'; \
        echo 'opcache.fast_shutdown=1'; \
        echo 'opcache.enable_cli=1'; \
    } > /usr/local/etc/php/conf.d/php-opocache-cfg.ini

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

COPY entrypoint.sh /etc/entrypoint.sh

ENTRYPOINT ["/etc/entrypoint.sh"]




