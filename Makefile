up:
	docker-compose up -d
down:
	docker-compose down
status:
	docker-compose ps
build:
	docker-compose up -d --build
build-no-cache:
	docker-compose build --no-cache
migrate:
	docker-compose exec php php artisan migrate
db-root:
	docker-compose exec mysql mysql -u root -p
install:
	docker-compose exec php composer install
	docker-compose exec node-front npm install
tinker:
	docker-compose exec php php artisan tinker
