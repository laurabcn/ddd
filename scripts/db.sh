#!/bin/bash

#This will cause the shell to exit immediately if a simple command exits with a nonzero exit value
set -e

echo DATABASE CONFIGURATION \(Environment: $SYMFONY_ENV\)

if [ "$SYMFONY_ENV" == "dev" ] || [ "$SYMFONY_ENV" == "test" ]; then
    if [ "$SYMFONY_ENV" != "prod" ]; then
    bin/console doctrine:schema:drop --force
    bin/console doctrine:schema:create
    bin/console doctrine:fixtures:load --no-interaction
    fi
fi

if [ "$SYMFONY_ENV" == "prod" ] || [ "$SYMFONY_ENV" == "staging" ] || [ "$SYMFONY_ENV" == "staging2" ]; then
    bin/console doctrine:migrations:migrate -n
fi

bin/console doctrine:cache:clear-query
bin/console doctrine:cache:clear-metadata
bin/console doctrine:cache:clear-result
