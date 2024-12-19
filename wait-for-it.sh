#!/bin/bash
until pg_isready -h $DB_HOST -p $DB_PORT -U $DB_USERNAME; do
  echo "Aguardando o banco de dados..."
  sleep 2
done
exec "$@"
