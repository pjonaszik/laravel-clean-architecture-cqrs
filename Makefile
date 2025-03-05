up:
	docker compose up -d
	docker compose exec todo_php composer install
	docker compose exec todo_php php artisan migrate
	docker compose exec todo_php php artisan migrate:fresh --env=testing
	#docker compose exec todo_php php artisan queue:work

cache:
	docker compose exec todo_php php artisan cache:clear
	docker compose exec todo_php php artisan config:clear
	docker compose exec todo_php php artisan route:clear
	docker compose exec todo_php composer dump-autoload

pint:
	docker compose exec -it todo_php ./vendor/bin/pint

test:
	docker compose exec todo_php php artisan test