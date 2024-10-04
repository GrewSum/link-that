FROM php:8.3-cli as build-env

RUN curl -sL https://deb.nodesource.com/setup_18.x | bash -
RUN apt-get install -y nodejs libxslt-dev libzip-dev libpng-dev --no-install-recommends \
    && echo "Node: $(node -v), path: $(which node)"  \
    && echo "NPM: $(npm -v), path: $(which npm)" \
    && npm install -g yarn

COPY --from=composer:2.5 /usr/bin/composer /usr/local/bin/composer

RUN docker-php-ext-install zip

RUN groupadd -g 1000 www && useradd -m -u 1000 -g www -s /bin/sh www

USER www

COPY --chown=www:www . /app
WORKDIR /app

RUN npm install \
    && npm run build \
    && rm -rf node_modules

RUN APP_ENV=ci composer install --optimize-autoloader --no-dev

FROM dunglas/frankenphp

ENV SERVER_NAME=:80

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY --from=build-env /app /app

COPY docker/entrypoint.sh /entrypoint.sh

RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
