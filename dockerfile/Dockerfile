FROM php:apache

# Local directories
ARG DOCKER_APACHE_DIR=dockerfile/apache2/
ARG DOCKER_SSL_DIR=dockerfile/ssl/

# Container directories
ARG APACHE_DIR=/etc/apache2/
ARG APACHE_CONF_AVAILABLES_DIR=${APACHE_DIR}conf-available/
ARG APACHE_SITES_AVAILABLES_DIR=${APACHE_DIR}sites-available/
ARG SSL_DIR=/etc/ssl/

# Copy apache configuration
COPY ${DOCKER_APACHE_DIR}conf/docker-php.conf ${APACHE_CONF_AVAILABLES_DIR}docker-php.conf

# Copy apache site
COPY ${DOCKER_APACHE_DIR}sites/default-ssl.conf ${APACHE_SITES_AVAILABLES_DIR}default-ssl.conf

# Copy ssl certificate
COPY ${DOCKER_SSL_DIR}server.crt ${SSL_DIR}certs/server.crt
COPY ${DOCKER_SSL_DIR}server.key ${SSL_DIR}private/server.key

# Enable apache modules
RUN a2enmod ssl
RUN a2enmod headers

# Enable apache configuration
RUN a2enconf docker-php

# Enable apache site
RUN a2ensite default-ssl