## Install application
install:

	# Composer
	composer install -n --prefer-dist --no-progress --no-suggest

	bin/console cache:clear
    bin/console doctrine:schema:drop --force
    bin/console doctrine:schema:create
    bin/console doctrine:fixtures:load --no-interaction

## Run tests
tests: phpunit integration behat

clearcache:
	bin/console cache:clear
	bin/console redis:flushall --client doctrine -n

phpunit:
	# PHPUnit
	vendor/bin/phpunit --no-coverage --exclude-group integration

integration:
	# PHPUnit
	bin/console doctrine:database:create --env=test --if-not-exists
	bin/console doctrine:schema:drop --env=test --force
	bin/console doctrine:schema:create --env=test
	vendor/bin/phpunit --no-coverage --group integration

behat:
	# Behat
	bin/console cache:clear --env=behat --no-warmup
	bin/console doctrine:database:create --env=behat --if-not-exists
	bin/console doctrine:schema:drop --env=behat --force
	bin/console doctrine:schema:create --env=behat
	bin/console doctrine:fixtures:load --no-interaction --env=behat

	vendor/bin/behat --profile default -f progress -vvv

## Generate Coverage Report
.PHONY: coverage
coverage:
	rm  -rf coverage
	# PHPUnit
	vendor/bin/phpunit --coverage-html coverage --configuration phpunit.xml --exclude-group integration

.PHONY: coverage-infra
coverage-infra:
	rm  -rf coverage-infra
	# PHPUnit
	vendor/bin/phpunit --coverage-html coverage-infra --configuration phpunit-infra.xml --exclude-group integration

## Run db creation and fixtures
db:
	./scripts/db.sh

## Run code style fixer
csfixer:
	./scripts/csfixer.sh
