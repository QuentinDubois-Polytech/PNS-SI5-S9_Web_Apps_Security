#!/usr/bin/env bash

# Verify that the openssl command is available
if ! command -v openssl &> /dev/null
then
    echo "openssl could not be found"
    exit
fi

# Create a directory to store the certificate and key
ssl_dir="$PWD/dockerfile/ssl"
mkdir "$ssl_dir" 2&> /dev/null
cd "$ssl_dir" || exit

# Generate a self-signed certificate for the server
openssl req \
       -newkey rsa:2048 -nodes -keyout server.key \
       -x509 -days 365 -out server.crt \
       -subj "/CN=host.com"