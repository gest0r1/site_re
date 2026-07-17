#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
LOCAL_DIR="$ROOT_DIR/local-env"
TS="$(date +%Y%m%d_%H%M%S)"
BACKUP_DIR="$LOCAL_DIR/backups/site_re-$TS"
mkdir -p "$BACKUP_DIR"

docker compose -f "$LOCAL_DIR/docker-compose.yml" exec -T db \
  mysqldump -uroot -prootpass gest0rmail | gzip -9 > "$BACKUP_DIR/db.sql.gz"

tar -czf "$BACKUP_DIR/uploads.tar.gz" \
  -C "$LOCAL_DIR/wordpress/wp-content" uploads

echo "$BACKUP_DIR"
