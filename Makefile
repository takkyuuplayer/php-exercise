PHP=$(shell which php)
TESTRUNNER=vendor/bin/testrunner
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
	$(PHP) vendor/bin/testrunner compile -p vendor/autoload.php

test:
	./vendor/bin/phpunit -c ./phpunit.xml tests

help:
	cat Makefile
