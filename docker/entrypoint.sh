#!/bin/sh

php artisan config:cache
php artisan optimize:clear
php artisan event:cache
php artisan route:cache
php artisan migrate --force

# This will exec the CMD from your Dockerfile
exec /usr/local/bin/docker-php-entrypoint "$@"
