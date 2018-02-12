.PHONY: vendor

PHP=$(shell which php)
COMPOSER=./composer.phar

all: vendor update

vendor: composer.phar
	$(COMPOSER) install

update: composer/update vendor/update

composer.phar:
	php -r "readfile('https://getcomposer.org/installer');" | php

composer/update: composer.phar
	$(COMPOSER) self-update

vendor/update: composer.phar
	$(COMPOSER) update

test:
	./vendor/bin/phpunit

lint:
	./vendor/bin/phpcbf tests

travis: composer/update
	cat composer.json | jq .require | jq keys -c | sed 's/[][,]/ /g' | xargs $(COMPOSER) require

help:
	cat Makefile
