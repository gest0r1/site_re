#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
LOCAL_DIR="$ROOT_DIR/local-env"
DOWNLOAD_BACKUP="${DOWNLOAD_BACKUP:-1}"
SSH_HOST="${SSH_HOST:-}"
SSH_USER="${SSH_USER:-}"
SSH_KEY_PATH="${SSH_KEY_PATH:-$HOME/.ssh/site_re_stage2}"
LOCAL_BACKUP_ROOT="${LOCAL_BACKUP_ROOT:-$LOCAL_DIR/backups}"

if [[ -z "$SSH_HOST" || -z "$SSH_USER" ]]; then
  if [[ -f "$ROOT_DIR/.env.site_re" ]]; then
    # shellcheck disable=SC1090
    source "$ROOT_DIR/.env.site_re"
    SSH_HOST="${SSH_HOST:-${SSH_HOST:-}}"
    SSH_USER="${SSH_USER:-${SSH_USER:-}}"
  fi
fi

if [[ -z "$SSH_HOST" || -z "$SSH_USER" ]]; then
  echo "SSH_HOST and SSH_USER are required" >&2
  exit 1
fi

remote() {
  ssh -i "$SSH_KEY_PATH" -o StrictHostKeyChecking=accept-new "$SSH_USER@$SSH_HOST" "$@"
}

remote_docroot="$(remote 'if [ -d "$HOME/дом-эксперт_рф/public_html" ]; then printf "%s" "$HOME/дом-эксперт_рф/public_html"; else printf "%s" "$HOME/public_html"; fi')"
ts="$(date +%Y%m%d_%H%M%S)"
remote_backup_dir="$(remote "printf '%s' \"\$HOME/backups/site_re/site_re-$ts\"")"

remote "set -euo pipefail
mkdir -p '$remote_backup_dir'
php8.3 ~/bin/wp-cli.phar --path='$remote_docroot' db export '$remote_backup_dir/db.sql' --quiet
gzip -9 '$remote_backup_dir/db.sql'
tar -czf '$remote_backup_dir/uploads.tar.gz' -C '$remote_docroot/wp-content' uploads
cd \"\$HOME/backups/site_re\"
ls -1dt site_re-* | tail -n +3 | xargs -r rm -rf
"

if [[ "$DOWNLOAD_BACKUP" == "1" ]]; then
  mkdir -p "$LOCAL_BACKUP_ROOT/site_re-$ts"
  rsync -az -e "ssh -i $SSH_KEY_PATH -o StrictHostKeyChecking=accept-new" \
    "$SSH_USER@$SSH_HOST:$remote_backup_dir/" \
    "$LOCAL_BACKUP_ROOT/site_re-$ts/"
  echo "$LOCAL_BACKUP_ROOT/site_re-$ts"
else
  echo "$remote_backup_dir"
fi
