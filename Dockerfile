FROM php:7.4-fpm

RUN apt-get update && apt-get install zip unzip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /app
WORKDIR /app


RUN chmod +x ./lib.sh
RUN ./lib.sh
WORKDIR /app/src
#
#VOLUME /app
CMD ["php-fpm", "-R"]