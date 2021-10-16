FROM php:7.2.18-apache

COPY . /var/www/html

RUN apt-get update && apt-get upgrade -y --allow-unauthenticated

RUN apt-get install -y curl git zip unzip

RUN a2enmod headers \
    && sed -ri -e 's/^([ \t]*)(<\/VirtualHost>)/\1\tHeader set Access-Control-Allow-Origin "*"\n\1\2/g' /etc/apache2/sites-available/*.conf

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html
RUN cd /var/www/html && \
    composer require fakerphp/faker
