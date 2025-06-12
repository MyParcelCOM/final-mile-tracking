FROM php:8.2-cli

COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

RUN apt-get update \
    && apt-get install -y unzip

COPY . /opt/app
WORKDIR /opt/app
