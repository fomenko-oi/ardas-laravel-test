init: down docker-build composer-install fresh-migrations npm-install frontend-build up

down:
	docker-compose down --remove-orphans

docker-build:
	docker-compose build --pull

composer-install:
	docker-compose run --rm php-cli composer install

fresh-migrations:
	docker-compose run --rm php-cli php artisan migrate:fresh --seed

npm-install:
	docker-compose run --rm node npm install

frontend-build:
	docker-compose run --rm node npm run prod

up:
	docker-compose up -d
