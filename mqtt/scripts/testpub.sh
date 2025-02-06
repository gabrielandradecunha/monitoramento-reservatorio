#/bin/bash

# exemplo de publicação de topico

sudo docker exec -it mosquitto mosquitto_pub -h localhost -p 1883 -t "reservatorio/volume" -m '{"mac": "teste", "volume": 5000.00}' -u "teste" -P "teste"
