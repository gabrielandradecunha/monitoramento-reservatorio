# Sistema de Monitoramento de Reservatórios d'agua

<img src="imgs/Peek 10-01-2025 02-58.gif" alt="Imagem do projeto"/>

Este projeto é um sistema de monitoramento de reservatórios de água desenvolvido com Laravel, Docker e PostgreSQL. O sistema coleta dados de níveis de água em tempo real, enviados por um microcontrolador para o banco de dados. A partir dessas informações, o sistema processa e exibe os dados de forma acessível para o administrador, permitindo o acompanhamento e a gestão eficiente dos reservatórios.

Alguns dos dados que o sistema fornece ao administrador

- **Volume**: Armazenamento, capacidade total e armazenamento atual do reservatório.
- **Vazão**: Determina quanto o volume do reservatório aumentou ou diminuiu.
- **Retenção**: Mede o volume total retido (reduções no volume).
- **Velocidade de Vazão e Retenção**: Quantifica as mudanças de volume em relação ao tempo.

# Install

Em um terminal bash, clone o repositório da aplicação e navegue até seu diretório
```bash
git clone https://github.com/andradesysadmin/monitoramento-reservatorio/
cd monitoramento-reservatorio
```

Primeiramente suba o container do PostgreSQL com o docker compose
``` bash
sudo docker-compose up -d
```
Instale as dependências com composer
```bash
composer install
```
Certifique-se de criar um .env com as credências corretas de conexão com o banco PostgreSQL
```bash
mv .env.example .env
```

um vez conectado ao banco, rode as migrações para criar as tabelas no banco
```bash
php artisan migrate
```

rode as seeders para criar o usuario <i>Administrator</i> que lhe conderá acesso ao sistema

```bash
php artisan db:seed
```
por fim, o mais importante, crie o gatilho no banco de dados para permitir registrar o histórico de alterações no banco pelo microcontrolador usando o script <i>init.sql</i>, isso é necessario pois o microcontrolador irá acessar diretamente o banco da aplicação para alterar o volume, por tanto, o gatilho deverá existir a nivel de banco e não de aplicação
```bash
sudo docker exec -it postgres_monit psql -U postgres -d postgres -f /docker-entrypoint-initdb.d/init.sql
```

# Docker install 
Alternativamente você pode subir a aplicação usando um container docker.

Em um terminal bash, clone o repositório da aplicação e navegue até seu diretório
```bash
git clone https://github.com/andradesysadmin/monitoramento-reservatorio/
cd monitoramento-reservatorio
```

Primeiramente suba o container do PostgreSQL com o docker compose
``` bash
sudo docker-compose up -d
```
Certifique-se de criar um .env apropriado para uma aplicação em container (ou apenas use o meu)
``` bash
sudo cp .docker.env .env
```
Em seguida suba o container
```bash
sudo docker build -t sysmonit .
sudo docker run -d --network monitoramento-reservatorio_monit -p 8080:8000 --name sysmonit sysmonit
```
como as migrações de banco de dados não podem ocorrer no momento de build da imagem (pelo fato do container não estar inserido na rede até ser criado), você precisará realizar as migrações e rodar as seeders após criar o container na rede do banco
```bash
sudo docker exec -it sysmonit php artisan migrate
sudo docker exec -it sysmonit php artisan db:seed
```

por fim, o mais importante, crie o gatilho no banco de dados para permitir registrar o histórico de alterações no banco pelo microcontrolador usando o script <i>init.sql</i>, isso é necessario pois o microcontrolador irá acessar diretamente o banco da aplicação para alterar o volume, por tanto, o gatilho deverá existir a nivel de banco e não de aplicação
```bash
sudo docker exec -it postgres_monit psql -U postgres -d postgres -f /docker-entrypoint-initdb.d/init.sql
```