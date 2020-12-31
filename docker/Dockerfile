FROM circleci/php:7.4

USER root

RUN apt-get update -y
RUN apt-get install -y \
    default-mysql-client

RUN docker-php-ext-install \
    intl \
    pdo \
    pdo_mysql \
    zip

USER circleci
