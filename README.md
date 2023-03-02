# task-api-laravel

## PHP version

```
8.2.2
```

## Laravel version

```
10.0.0
```

## Local Development
```shell script
# 用意
docker compose build

# 起動
docker compose up -d

Laravelプロジェクトに暗号化キー　設定
php artisan key:generate

# シャットダウン
docker-compose down

# 開始
docker-compose start

# 停止
docker-compose stop

# 再起動
docker-compose restart
```

## 初回セットアップ
```shell script
# src/.env を作成し下記のenvの内容を記載する。

# app の中に入る
docker compose exec app bash

# app_key の追加
php artisan key:generate

# db:migrate
php artisan db:migrate

# seedデータの追加
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=TaskSeeder
php artisan db:seed --class=TaskUserSeeder

# HTTPレスポンス一覧のインストール
composer require symfony/http-foundation

# swagger のインストール
composer require "darkaonline/l5-swagger"

# 初回ドキュメント生成
php artisan l5-swagger:generate
```

#env
```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=database
DB_USERNAME=user
DB_PASSWORD=password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

L5_SWAGGER_GENERATE_ALWAYS=true

```
