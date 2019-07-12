### UNIT-TEST ###
.PHONY: tests
tests:
	docker exec -it activities-php-fpm php ./vendor/bin/phpunit