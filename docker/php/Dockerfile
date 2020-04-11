FROM nanoninja/php-fpm:7.3.2

RUN apt-get update && \
    apt-get install -y git wget libssl-dev libmcrypt-dev zlib1g-dev libxml2-dev libicu-dev g++ make cmake autoconf gcc libgmp-dev uuid-dev && \
    apt-get autoclean -y && \
    apt-get clean -y

RUN docker-php-ext-install pdo_mysql exif mbstring soap bcmath zip intl

# Install xdebug for development
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN apt-get update && \
    apt-get install curl -y && \
    apt-get autoclean -y && \
    apt-get clean -y && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN /usr/local/bin/composer global require "fxp/composer-asset-plugin:~1.4.6"


