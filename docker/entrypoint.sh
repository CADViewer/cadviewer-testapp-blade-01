#!/bin/sh
set -e
cd /var/www/html

if [ -z "$APP_KEY" ]; then
    APP_KEY="base64:$(head -c 32 /dev/urandom | base64)"
    export APP_KEY
    echo "WARNING: APP_KEY is not set, using a random key (sessions are lost on restart)." >&2
fi

# Persistent volumes are mounted empty and owned by root on first start
mkdir -p public/converters/files/pdf public/converters/files/print public/converters/files/merged \
    public/php/logs storage/framework/cache storage/framework/sessions storage/framework/views storage/logs
chown -R www-data:www-data public/converters/files public/content/redlines public/php/logs storage bootstrap/cache

exec "$@"
