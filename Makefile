type = patch
comment = Release $(type)
dir := $(shell pwd)
.PHONY: up
up:
	cd docker && docker-compose up -d && docker-compose exec php sh -c "php artisan serve --host 0.0.0.0"

.PHONY: install
install:
	cd docker && docker-compose build && docker-compose up -d && docker-compose exec php sh -c "composer install && cp .env.example .env && php artisan migrate" && docker-compose down

.PHONY: php
php:
	cd docker && docker-compose exec php bash

.PHONY: mysql
mysql:
	cd docker && docker-compose exec mysql56 bash

.PHONY: down
down:
	cd docker && docker-compose down

.PHONY: restart
restart:
	cd docker && docker-compose down && docker-compose up --force-recreate -d && docker-compose exec php sh -c "nohup php artisan serve --host 0.0.0.0 &"

.PHONY: database
database:
	cd docker && docker-compose exec php sh -c "php artisan migrate"

.PHONY: tests
tests:
	cd docker && docker-compose exec php sh -c "vendor/bin/phpunit -d memory_limit=-1 --testdox"

