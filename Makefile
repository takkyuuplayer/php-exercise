.PHONY: test vendor vendor/update
PHP=$(shell which php)
TESTRUNNER=vendor/bin/testrunner
CURL=$(shell which curl)
ifneq ("$(wildcard composer.phar)", "")
COMPOSER=./composer.phar
else
COMPOSER=composer
endif

all: vendor vendor/update

vendor:
	$(COMPOSER) install

vendor/update:
	$(COMPOSER) update

composer:
	$(CURL) -s https://getcomposer.org/installer | php

composer/update:
	$(COMPOSER) self-update

test:
	./vendor/bin/phpunit

travis: composer/update
	cat composer.json | jq .require | jq keys -c | sed 's/[][,]/ /g' | xargs $(COMPOSER) require

help:
	cat Makefile
