PHP=$(shell which php)
TESTRUNNER=vendor/bin/testrunner
CURL=$(shell which curl)
ifneq ("$(wildcard composer.phar)", "")
COMPOSER=./composer.phar
else
COMPOSER=composer
endif

all: composer-update setup

setup:
	$(COMPOSER) install
	$(COMPOSER) update

reinstall:
	cat composer.json | jq .require | jq keys -c | sed 's/[][,]/ /g' | xargs $(COMPOSER) require

composer-update:
	$(COMPOSER) self-update

test:
	./vendor/bin/phpunit

composer-install:
	$(CURL) -s https://getcomposer.org/installer | php

test-runner:
	$(PHP) vendor/bin/testrunner compile -p vendor/autoload.php

help:
	cat Makefile
