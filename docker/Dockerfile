FROM php

RUN apt-get update -y
RUN apt-get install -y git make mysql-client

RUN apt-get install -y libicu-dev
RUN docker-php-ext-install intl
RUN docker-php-ext-install pdo pdo_mysql
