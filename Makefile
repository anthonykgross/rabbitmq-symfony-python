
FIG=docker-compose
RUN_PHP=$(FIG) run --rm php
EXEC_PHP=$(FIG) exec php

RUN_PYTHON=$(FIG) run --rm python
EXEC_PYTHON=$(FIG) exec python

.DEFAULT_GOAL := help
.PHONY: help build install start stop debug-python debug-php

help:
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/##//'

##
## Project setup
##---------------------------------------------------------------------------

build:          ## Build the Docker image
build:
	$(FIG) build

install:        ## Install vendors
install:
	$(RUN_PHP) install
	$(RUN_PYTHON) install

start:          ## Install the full project (build install db db-migrate up)
start: build install up

stop:           ## Stop containers
stop:
	$(FIG) kill
	$(FIG) rm -v --force

up:             ## Run images
up:
	docker-compose up -d

##
## Tests
##---------------------------------------------------------------------------

debug-python:          ## Debug container
debug-python:
	$(EXEC_PYTHON) gosu docker bash

debug-python-root:          ## Debug container as Root
debug-python-root:
	$(EXEC_PYTHON) bash

debug-php:     ## Debug container as Root user
debug-php:
	$(EXEC_PHP) gosu docker bash

debug-php-root:          ## Debug container as Root
debug-php-root:
	$(EXEC_PHP) bash

##