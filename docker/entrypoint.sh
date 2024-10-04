#!/bin/sh
set -e

php artisan config:cache
php artisan optimize:clear
php artisan event:cache
php artisan route:cache

php artisan migrate --force --ansi

if [ "${1#-}" != "$1" ]; then
	set -- frankenphp run "$@"
fi

exec "$@"
