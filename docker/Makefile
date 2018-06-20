DOCKER=$(shell which docker)
DOCKER_COMPOSE=$(shell which docker-compose)
CONTAINER_NAME=php-exercise

up:
	$(DOCKER_COMPOSE) -p $(CONTAINER_NAME) up -d --build

build:
	$(DOCKER_COMPOSE) build

clean: stop rm

attach:
	@$(DOCKER) exec -it $(CONTAINER_NAME) bash

stop:
	$(DOCKER_COMPOSE) -p $(CONTAINER_NAME) stop

rm:
	$(DOCKER_COMPOSE) -p $(CONTAINER_NAME) rm -f

run:
	@$(DOCKER) exec -i $(CONTAINER_NAME) php $(SRC)

run-test:
	@$(DOCKER) exec -i $(CONTAINER_NAME) ./vendor/bin/phpunit $(SRC)
