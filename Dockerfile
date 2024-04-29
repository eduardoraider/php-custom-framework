FROM php:8.3-cli

RUN apt update && \
    apt install -y libpq-dev && \
    docker-php-ext-install pdo_mysql

RUN docker-php-ext-install sockets