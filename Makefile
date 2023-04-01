build: _build
up: _up
down: _down
in: _in
fixtures: _fixtures
tests: _tests

_build:
	docker-compose build --no-cache db && docker-compose up -d && docker exec -it v-crm-php composer install

_fixtures:
	docker exec -it php bin/console doctrine:schema:drop --full-database --force && docker exec -it php php bin/console d:m:m --no-interaction && docker exec -it php php bin/console doctrine:fixtures:load --no-interaction

_up:
	docker-compose up -d

_down:
	docker-compose down

_in:
	docker exec -it v-crm-php bash

_tests:
	docker exec -it v-crm-php bin/phpunit
