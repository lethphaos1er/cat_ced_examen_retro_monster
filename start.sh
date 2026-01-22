#!/bin/sh
set -e

php artisan key:generate --force || true

php artisan config:clear || true
php artisan cache:clear || true
php artisan route:clear || true
php artisan view:clear || true

php artisan migrate --force || true

exec apache2-foreground
