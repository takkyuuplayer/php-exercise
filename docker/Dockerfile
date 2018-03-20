FROM php

RUN apt-get update -y
RUN apt-get install -y git make

RUN apt-get install -y libicu-dev
RUN docker-php-ext-install intl
