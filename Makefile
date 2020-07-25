### UNIT-TEST ###
.PHONY: tests
tests:
	docker exec -i activities-php-fpm php /app/bin/phpunit

### START ###
.PHONY: start
start:
	docker-compose -f docker-compose.yml stop \
    && rm -rf var/cache/* \
	&& docker-compose -f docker-compose.yml up -d

### HARD ###
.PHONY: hard
hard:
	docker-compose -f docker-compose.yml stop \
	&& docker rm $$(docker ps -a -q) \
	&& docker rmi -f $$(docker images -q)   \
	&& docker-compose -f docker-compose.yml up -d --build --force-recreate


### STOP ###
.PHONY: stop
stop:
	docker-compose -f docker-compose.yml stop

### LOGIN ###
.PHONY: login
login:
	 docker exec -it activities-php-fpm su www-data -s /bin/bash
