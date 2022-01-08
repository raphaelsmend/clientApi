type = patch
comment = Release $(type)
dir := $(shell pwd)
.PHONY: up
up:
	cd install-files && docker-compose up -d && docker-compose exec php sh -c "cd /var/www/html/shortener-api && php artisan serve --host 0.0.0.0"

.PHONY: install
install:
	cd install-files && docker-compose build && docker-compose up -d && docker-compose exec php sh -c "cd /var/www/html/shortener-api && composer install && cp .env.example .env && php artisan migrate && php artisan db:seed" && docker-compose down

.PHONY: php
php:
	cd install-files && docker-compose exec php bash

.PHONY: mysql
mysql:
	cd install-files && docker-compose exec mysql56 bash

.PHONY: down
down:
	cd install-files && docker-compose down

.PHONY: restart
restart:
	cd install-files && docker-compose down && docker-compose up --force-recreate -d && docker-compose exec php sh -c "cd /var/www/html/shortener-api && nohup php artisan serve --host 0.0.0.0 &"

.PHONY: database
database:
	cd install-files && docker-compose exec php sh -c "cd /var/www/html/shortener-api && php artisan migrate && php artisan db:seed"

.PHONY: tests
tests:
	cd install-files && docker-compose exec php sh -c "cd /var/www/html/shortener-api && vendor/bin/phpunit -d memory_limit=-1 --testdox"

.PHONY: clean-mysql
clean-mysql:
	cd docker/mysql && sudo rm -rf *
