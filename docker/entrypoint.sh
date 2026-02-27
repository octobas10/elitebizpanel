#!/bin/sh
# Ensure Yii runtime and assets are writable by the web server (bind-mount safe)
RUNTIME="/var/www/html/protected/runtime"
ASSETS="/var/www/html/assets"
mkdir -p "$RUNTIME" "$ASSETS"
chown -R www-data:www-data "$RUNTIME" "$ASSETS" 2>/dev/null || true
chmod -R 777 "$RUNTIME" "$ASSETS" 2>/dev/null || true
if [ $# -eq 0 ]; then set -- apache2-foreground; fi
exec "$@"
