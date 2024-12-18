FROM ubuntu:24.04

RUN apt update && apt install php8.3-curl php8.3-pgsql php8.3-xml php8.3-fpm postgresql-client -y

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html/

COPY . .

RUN composer install
#RUN php artisan migrate

EXPOSE 8000

CMD ["php","artisan","serve"]
