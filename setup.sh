#!/bin/bash

# summary of commands to setup aplication

sudo docker-compose up -d
mv .env.example .env
composer install
php artisan migrate
php artisan db:seed
php artisan key:generate
sudo docker exec -it postgres_monit psql -U postgres -d postgres -f /docker-entrypoint-initdb.d/init.sql
