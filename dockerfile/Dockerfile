FROM php:apache

# Install PHP extensions
COPY conf/docker-php.conf /etc/apache2/conf-available/docker-php.conf
COPY conf/hosts /etc/hosts

RUN a2enmod headers




