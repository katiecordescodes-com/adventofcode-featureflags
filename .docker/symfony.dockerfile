FROM composer:2.5.1 as build

WORKDIR /app

COPY composer.json composer.json
COPY composer.lock composer.lock
COPY symfony.lock symfony.lock

ENV APP_ENV prod
ENV APP_DEBUG 0

RUN composer install --no-dev --optimize-autoloader --no-scripts

FROM nginx/unit:1.29.0-php8.1 as image

RUN mkdir /var/app/ && groupadd -r symfony && useradd --no-log-init -r -g symfony symfony && chown -R symfony:symfony /var/app/

WORKDIR /var/app

COPY --chown=symfony:symfony --from=build /app/vendor /var/app/vendor
COPY --chown=symfony:symfony bin /var/app/bin
COPY --chown=symfony:symfony config /var/app/config
COPY --chown=symfony:symfony public /var/app/public
COPY --chown=symfony:symfony src /var/app/src
COPY --chown=symfony:symfony .env /var/app/.env
COPY --chown=symfony:symfony composer.json /var/app/composer.json

COPY .docker/.unit.conf.json.prod /docker-entrypoint.d/.unit.conf.json
CMD ["unitd", "--no-daemon", "--control", "unix:/var/run/control.unit.sock"]