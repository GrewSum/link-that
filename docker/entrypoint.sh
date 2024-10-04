#!/bin/sh
set -e

FILE=database/database.sqlite
if [ ! -f "$FILE" ]; then
    echo "No database file found. Creating one..."
    touch "$FILE"
fi

php artisan migrate --graceful --ansi

php artisan config:cache
php artisan optimize:clear
php artisan event:cache
php artisan route:cache

if [ "${1#-}" != "$1" ]; then
	set -- frankenphp run "$@"
fi

exec "$@"
