#!/bin/sh
set -e

php artisan config:cache
php artisan optimize:clear
php artisan event:cache
php artisan route:cache
php artisan migrate --force

if [ "${1#-}" != "$1" ]; then
	set -- php-fpm "$@"
fi

exec "$@"
