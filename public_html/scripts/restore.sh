#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
LOCAL_DIR="$ROOT_DIR/local-env"
SOURCE="${1:-}"
FILES_ARCHIVE="${2:-}"

if [[ -z "$SOURCE" ]]; then
  echo "Usage: restore.sh /path/to/backup-dir | /path/to/db.sql.gz [uploads.tar.gz]" >&2
  exit 1
fi

if [[ -d "$SOURCE" ]]; then
  DB_DUMP="$SOURCE/db.sql.gz"
  FILES_ARCHIVE="$SOURCE/uploads.tar.gz"
elif [[ -f "$SOURCE" ]]; then
  DB_DUMP="$SOURCE"
else
  echo "Backup source not found: $SOURCE" >&2
  exit 1
fi

docker compose -f "$LOCAL_DIR/docker-compose.yml" exec -T db \
  mysql -uroot -prootpass -e 'DROP DATABASE IF EXISTS gest0rmail; CREATE DATABASE gest0rmail CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;'

gunzip -c "$DB_DUMP" | docker compose -f "$LOCAL_DIR/docker-compose.yml" exec -T db \
  mysql -uroot -prootpass gest0rmail

if [[ -n "$FILES_ARCHIVE" ]]; then
  mkdir -p "$LOCAL_DIR/wordpress/wp-content/uploads"
  TMP_RESTORE="$(mktemp -d)"
  tar -xzf "$FILES_ARCHIVE" -C "$TMP_RESTORE"
  rsync -a --delete "$TMP_RESTORE/uploads/" "$LOCAL_DIR/wordpress/wp-content/uploads/"
  rm -rf "$TMP_RESTORE"
fi

docker compose -f "$LOCAL_DIR/docker-compose.yml" exec -T db \
  mysql -uroot -prootpass gest0rmail -e "UPDATE wp_options SET option_value='http://site-re.local:8080' WHERE option_name IN ('home','siteurl');"

echo "RESTORE_OK"
