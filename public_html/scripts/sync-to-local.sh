#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
LOCAL_DIR="$ROOT_DIR/local-env"
WP_DIR="$LOCAL_DIR/wordpress"

mkdir -p "$WP_DIR/wp-content/themes/site-re-theme"
mkdir -p "$WP_DIR/wp-content/plugins/site-re-core"
mkdir -p "$WP_DIR/wp-content/mu-plugins"

sync_dir() {
  local src="$1"
  local dst="$2"
  if [[ -d "$src" ]]; then
    rsync -a --delete "$src/" "$dst/"
  fi
}

sync_file() {
  local src="$1"
  local dst="$2"
  if [[ -f "$src" ]]; then
    cp "$src" "$dst"
  fi
}

sync_dir "$ROOT_DIR/wp-content/themes/site-re-theme" "$WP_DIR/wp-content/themes/site-re-theme"
sync_dir "$ROOT_DIR/wp-content/plugins/site-re-core" "$WP_DIR/wp-content/plugins/site-re-core"
sync_dir "$ROOT_DIR/wp-content/mu-plugins" "$WP_DIR/wp-content/mu-plugins"

sync_file "$ROOT_DIR/root-assets/.htaccess" "$WP_DIR/.htaccess"
sync_file "$ROOT_DIR/root-assets/robots.txt" "$WP_DIR/robots.txt"

echo "SYNC_OK"
