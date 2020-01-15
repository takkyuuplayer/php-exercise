FROM circleci/php:7.3

USER root

RUN apt-get update -y
RUN apt-get install -y \
    git \
    make \
    mysql-client \
    unzip

RUN docker-php-ext-install \
    intl \
    pdo \
    pdo_mysql \
    zip

USER circleci
