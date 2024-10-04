#!/bin/sh
set -e

php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite')"
php artisan migrate --graceful --ansi

php artisan config:cache
php artisan optimize:clear
php artisan event:cache
php artisan route:cache

if [ "${1#-}" != "$1" ]; then
	set -- frankenphp run "$@"
fi

exec "$@"
