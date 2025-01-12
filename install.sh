#!/bin/bash

# install full app with this script

git clone https://github.com/andradesysadmin/monitoramento-reservatorio/
cd monitoramento-reservatorio
sudo docker-compose up -d
cp .env.example .env
php artisan key:generate
php artisan db:seed
sudo docker exec -it postgres_monit psql -U postgres -d postgres -f /docker-entrypoint-initdb.d/init.sql
php artisan serve