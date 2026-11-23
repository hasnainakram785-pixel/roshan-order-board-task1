#!/usr/bin/env bash
# Creates the Laravel project and drops the Task 1 files into it.
# Usage:  bash setup.sh        (needs PHP 8.2+, Composer, Git)
set -euo pipefail

HERE="$(cd "$(dirname "$0")" && pwd)"
TARGET="${1:-roshan-order-board}"

composer create-project laravel/laravel "$TARGET"
cp -R "$HERE/overlay/." "$TARGET/"

cd "$TARGET"
# Switch the DB settings in .env from SQLite to MySQL
sed -i.bak -E \
  -e 's/^DB_CONNECTION=.*/DB_CONNECTION=mysql/' \
  -e 's/^# ?DB_HOST=.*/DB_HOST=127.0.0.1/' \
  -e 's/^# ?DB_PORT=.*/DB_PORT=3306/' \
  -e 's/^# ?DB_DATABASE=.*/DB_DATABASE=roshan_orders/' \
  -e 's/^# ?DB_USERNAME=.*/DB_USERNAME=root/' \
  -e 's/^# ?DB_PASSWORD=.*/DB_PASSWORD=/' .env
rm -f .env.bak

echo
echo "Done. Next:"
echo "  1) Create the database:  mysql -u root -e \"CREATE DATABASE roshan_orders\""
echo "  2) cd $TARGET && php artisan migrate --seed"
echo "  3) git init && git add . && git commit -m 'Task 1: orders migration and seeder' and push to GitHub"
