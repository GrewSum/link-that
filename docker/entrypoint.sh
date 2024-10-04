#!/bin/sh
set -e

FILE=database/database.sqlite
if [ -d "$FILE" ]; then
    # Remove the database file if it's a directory
    rm -rf "$FILE"
fi
if [ ! -f "$FILE" ]; then
    # Create the database file if it doesn't exist
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
