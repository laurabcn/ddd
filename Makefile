### UNIT-TEST ###
.PHONY: tests
tests:
	docker exec -i activities-php-fpm php ./vendor/bin/phpunit