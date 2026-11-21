#!/bin/sh

set -e

php artisan serve --host=0.0.0.0 --port="${PORT:-10000}" &
SERVER_PID=$!

sleep 2
php artisan migrate --force

wait "$SERVER_PID"
