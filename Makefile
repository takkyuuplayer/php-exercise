PHP=$(shell which php)
CURL=$(shell which curl)
ifneq ("$(wildcard composer.phar)", "")
COMPOSER=./composer.phar
else
COMPOSER=composer
endif

all: composer-update composer-setup

composer-update:
	$(COMPOSER) self-update

composer-setup:
	$(COMPOSER) install
	$(COMPOSER) update

test:
	./vendor/bin/phpunit

composer-install:
	$(CURL) -s https://getcomposer.org/installer | php

help:
	cat Makefile
