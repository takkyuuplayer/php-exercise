FROM php:7.2

RUN apt-get update -y
RUN apt-get install -y \
    git \
    make \
    mysql-client \
    unzip
RUN apt-get install -y \
    libicu-dev \
    zlib1g-dev
RUN docker-php-ext-install \
    intl \
    pdo \
    pdo_mysql \
    zip
