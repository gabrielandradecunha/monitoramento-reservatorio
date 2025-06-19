#!/bin/bash

# Simulando o esp32

echo "Nome do reservatorio: "; read NOME;
echo "Insira o volume atual: "; read VOLUME;

sudo docker exec -it postgres_monit psql -U postgres -h 127.0.0.1 -c "UPDATE reservatorios SET volume_atual = $VOLUME WHERE nome = '$NOME';"
