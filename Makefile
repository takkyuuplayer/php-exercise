.PHONY: vendor db

PHP=$(shell which php)
COMPOSER=./composer.phar

all: vendor db update

vendor: composer.phar
	$(COMPOSER) install

update: composer/update vendor/update

composer.phar:
	php -r "readfile('https://getcomposer.org/installer');" | php

composer/update: composer.phar
	$(COMPOSER) self-update

vendor/update: composer.phar
	$(COMPOSER) update

db:
	mysql -uroot --host=mysql-server -e "DROP DATABASE IF EXISTS test"
	mysql -uroot --host=mysql-server -e "CREATE DATABASE IF NOT EXISTS test DEFAULT CHARACTER SET utf8"
	mysql -uroot --host=mysql-server -e "GRANT ALL PRIVILEGES ON test.* TO 'testuser'@'%%' IDENTIFIED BY 'testpass'"

test:
	./vendor/bin/phpunit

lint:
	./vendor/bin/phpcbf tests

travis: composer/update
	cat composer.json | jq .require | jq keys -c | sed 's/[][,]/ /g' | xargs $(COMPOSER) require

help:
	cat Makefile
