FROM php:7.4-cli

WORKDIR /app

RUN apt update && apt -y install git && apt -y install unzip 
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN curl https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony

COPY ./app/composer.json /app
RUN composer install