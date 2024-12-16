#!/bin/bash

git clone https://github.com/andradesysadmin/monitoramento-reservatorio/
cd monitoramento-reservatorio
sudo docker-compose up -d
cp .env.example .env
php artisan key:generate
php artisan db:seed
php artisan serve