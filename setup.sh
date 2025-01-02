#!/bin/bash

# resumo dos comandos usados para subir a aplicaão

sudo docker-compose up -d
composer install
php artisan migrate
php artisan db:seed
php artisan key:generate
sudo docker exec -it postgres_monit psql -U postgres -d postgres -f /docker-entrypoint-initdb.d/init.sql
