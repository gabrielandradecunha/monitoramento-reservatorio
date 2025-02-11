#/bin/bash

# example of topic publish

sudo docker exec -it mosquitto mosquitto_pub -h broker.hivemeq.com -p 1883 -t "gps/vivo/cuiaba" -m '{"latitude":"3","longitude":"-56.098776","Nivel_agua":"5000","MACAddress":"88:13:BF:68:9F:68","Data":"2025/02/06","hora_cuiaba":"16:40:16"}' #-u "teste" -P "teste"
