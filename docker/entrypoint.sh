#!/bin/sh
set -e

if [ -z "$APP_KEY" ]; then
  echo "APP_KEY missing"
  exit 1
fi

# IMPORTANT : PAS DE CACHE tant que tout n'est pas stable
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true

exec apache2-foreground
