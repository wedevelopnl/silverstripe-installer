#!/bin/sh
set -e

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
    set -- php-fpm "$@"
fi

if [ "$1" = 'php-fpm' ] && [ "$SS_ENVIRONMENT_TYPE" != 'live' ]; then
    composer install --prefer-dist --no-progress --no-suggest --no-interaction

    until nc -z -v -w30 $SS_DATABASE_SERVER 3306
    do
      echo "Waiting for database connection..."
      sleep 1
    done

    ./vendor/bin/sake dev/build "flush=1"
fi

exec docker-php-entrypoint "$@"
