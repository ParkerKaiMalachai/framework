DOCKER_COMPOSE = docker-compose.yaml

build:
	docker compose -f $(DOCKER_COMPOSE) up --build -d
start: 
	docker compose -f $(DOCKER_COMPOSE) up -d
down:
	docker compose -f $(DOCKER_COMPOSE) down
migrate_up:
	docker exec -it framework-php-1 php Console/Commands/Migration.php --direction=up
migrate_down:
	docker exec -it framework-php-1 php Console/Commands/Migration.php --direction=down