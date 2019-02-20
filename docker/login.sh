#!/bin/bash

if [[ $1 == "web" ]]; then
    docker exec -it activities-php-fpm su www-data -s /bin/bash
elif [[ $1 == "db" ]]; then
    docker exec -it activities-mysql /bin/bash
elif [[ $1 == "webroot" ]]; then
    docker exec -it activities_activities_1 /bin/bash
elif [[ $1 == "redis" ]]; then
    docker exec -it activities-redisapp /bin/bash
elif [[ $1 == "aws" ]]; then
    aws ecr get-login --no-include-email --region eu-west-1
else
    echo "Incorrect container name."
fi