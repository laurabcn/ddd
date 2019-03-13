## Install application
install:
	# Copy deployment files from S3
	./scripts/copy_s3_deployment_files.sh

	# Composer
	composer install -n --prefer-dist --no-progress --no-suggest

	# Add npm auth token
	echo "//registry.npmjs.org/:_authToken=a8747e16-33de-4ccb-8d1a-4c0f5f686463" > ~/.npmrc

	# Npm
	yarn install

	# Build front (React+WebJs+WebCss) or download from S3 if exists
	./scripts/build_js_app.sh

	# Build images and inject critical
	yarn gulp criticalBuild

	# Translations
	php bin/console translation:transifex:download
	bin/console cache:clear

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
