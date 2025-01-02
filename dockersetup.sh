#!/bin/bash

# Comandos para subir a aplicação com docker

sudo docker-compose up -d
sudo cp .docker.env .env
sudo docker build -t sysmonit .
sudo docker run -d --network monitoramento-reservatorio_monit -p 8080:8000 --name sysmonit sysmonit
sudo docker exec -it sysmonit php artisan migrate
sudo docker exec -it sysmonit php artisan db:seed
sudo docker exec -it postgres_monit psql -U postgres -d postgres -f /docker-entrypoint-initdb.d/init.sql