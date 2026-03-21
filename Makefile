# Define the PHP binary and PHPUnit comman# Define the PHP binary and PHPUnit command
PHP := php
DOCKER := docker
DOCKER_COMPOSE := docker compose
EXEC_APP := $(DOCKER_COMPOSE) exec app

.PHONY: start stop test lint help

# Start the Docker containers
start:
	$(DOCKER_COMPOSE) up -d

# Stop the Docker containers
stop:
	$(DOCKER_COMPOSE) down

# Run tests
test:
	$(EXEC_APP) composer test

# Run tests
lint:
	$(EXEC_APP) composer lint

help:
	@echo "Makefile commands:"
	@echo "  make start                    - Start the Docker containers"
	@echo "  make stop                     - Stop the Docker containers"
	@echo "  make test                     - Run tests"
	@echo "  make lint                     - Run code linter"