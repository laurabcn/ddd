º#!/bin/bash

docker-compose -f docker-compose.yml stop
rm -rf var/cache/*

if [[ $1 == "hard" ]]; then
    docker-compose rm -f #remove your containers and your data volumes
    docker rmi $(docker images -q)
    docker rm $(docker ps -a -q)
    docker-compose -f docker-compose.yml up -d --build --force-recreate
elif [[ $1 == "recreate" ]]; then
    docker rm $(docker ps -a -q)
    docker-compose -f docker-compose.yml up -d --build --force-recreate
elif [[ $1 != ''  ]]; then
    echo 'wrong docker parameter'
else
    docker-compose -f docker-compose.yml up -d
fi

docker ps