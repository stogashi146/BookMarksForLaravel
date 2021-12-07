# ビルドのためのベースイメージ
FROM php:8.0-fpm-buster@sha256:ee83848d172b588e00c496c3d5cce2cecbcac0b76339c370870f03af7b82e8f8
SHELL ["/bin/bash", "-oeux", "pipefail", "-c"]

# サーバー環境変数
ENV COMPOSER_ALLOW_SUPERUSER=1 \
  COMPOSER_HOME=/composer

COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer
COPY backend /work
COPY infra/php/php.ini /usr/local/etc/php/php.ini

RUN apt-get update && \
  apt-get install -y git zip unzip libzip-dev libicu-dev libonig-dev vim procps && \
  apt-get clean && \
  rm -rf /var/lib/apt/lists/* && \
  docker-php-ext-install intl pdo_mysql zip bcmath && \
  composer require doctrine/dbal
# composer require laravelcollective/html && \
# chown -R www-data:www-data storage

WORKDIR /work
