# docker-larabel-handson

## 必要なコマンド類は別途インストールする
```
apt-get update &&
apt-get install -y vim procps
```

## 必要なライブラリをインストール
```
composer install
php artisan key:generate
php artisan migrate
```
