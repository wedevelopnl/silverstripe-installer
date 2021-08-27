ARG ALPINE_VERSION=3.10
ARG NODE_VERSION=15.7

FROM node:$NODE_VERSION-alpine$ALPINE_VERSION AS node
FROM php:7.4-fpm-alpine$ALPINE_VERSION AS php-fpm

ARG ALPINE_VERSION

# https://gitlab.com/gitlab-com/support-forum/issues/4506#note_168031167
RUN echo "http://mirror.leaseweb.com/alpine/v$ALPINE_VERSION/main" > /etc/apk/repositories
RUN echo "http://mirror.leaseweb.com/alpine/v$ALPINE_VERSION/community" >> /etc/apk/repositories

RUN apk update && apk upgrade\
   wget

RUN apk add --no-cache libzip-dev && docker-php-ext-configure zip && docker-php-ext-install zip
RUN apk add --no-cache curl bash make mysql-client git icu-dev libjpeg-turbo-dev libpng-dev acl
RUN docker-php-ext-configure gd --with-jpeg=/usr/include/
RUN docker-php-ext-install pdo_mysql intl gd

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY dev/docker/fpm/default.ini $PHP_INI_DIR/conf.d/

WORKDIR /app

COPY composer.json composer.lock* ./

RUN composer install --prefer-dist --no-dev --no-autoloader --no-scripts --no-progress
RUN composer clear-cache

COPY phpstan.neon ./
COPY app app/
COPY public public/
COPY themes themes/

RUN apk add --no-cache libstdc++
COPY --from=node /usr/local/bin/node /usr/local/bin/node
COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules
RUN ln -s ../lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

COPY .npmrc package.json package-lock.json webpack.config.js stylelint.config.js .stylelintignore .eslintrc.js ./
RUN npm install
RUN npm run build
RUN rm -rf node_modules

RUN composer dump-autoload --classmap-authoritative --no-dev
RUN composer run-script --no-dev post-install-cmd
RUN composer vendor-expose copy

RUN chown -R www-data:www-data public

COPY dev/docker/fpm/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

ENTRYPOINT ["docker-entrypoint"]
CMD ["php-fpm"]

#------------------------------------

FROM php-fpm AS php-fpm-test

RUN set -eux; \
    composer install --prefer-dist --no-scripts --no-progress --no-suggest; \
    composer clear-cache

COPY Makefile .php_cs phpstan.neon ./

#------------------------------------

FROM nginx:1.17-alpine AS nginx

COPY dev/docker/nginx/production.conf /etc/nginx/conf.d/default.conf

COPY --from=php-fpm /app/public /app/public

#------------------------------------

FROM php-fpm AS deploy

RUN apk add --no-cache openssh-client rsync

COPY deployer.phar deploy.php ./

#----------------------------------

FROM php-fpm AS php-fpm-dev

RUN set -eux; \
    apk add --no-cache --virtual .build-deps $PHPIZE_DEPS; \
    pecl install xdebug; \
    docker-php-ext-enable xdebug

COPY dev/docker/fpm/xdebug.ini $PHP_INI_DIR/conf.d/
