#!/bin/bash

# run it before up docker-compose

cd mosquitto/config/
touch pass
cd ../../../

sudo docker-compose up -d

sudo docker exec -it mosquitto mosquitto_passwd -c /mosquitto/config/pass teste
