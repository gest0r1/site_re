#!/usr/bin/env bash
set -euo pipefail

# === Stage 5 Production Seed ===
# Syncs SVG assets + seeds Gutenberg pages + Custom CSS
# Usage: bash scripts/prod-seed-stage5.sh
# Must have SSH key access to production (GitHub deploy key)

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
source "$ROOT_DIR/.env.site_re" 2>/dev/null || true
: "${SSH_USER:=gest0rmail}" "${SSH_HOST:=xn----gtbetilkjgn9i.xn--p1ai.swtest.ru}"

if ! ssh -o BatchMode=yes -o ConnectTimeout=5 "$SSH_USER@$SSH_HOST" exit 2>/dev/null; then
  echo "No SSH key access. Use deploy key from GitHub Actions."
  echo "Manual steps:"
  echo "1. git push → deploy → then ssh and run:"
  echo "   curl -sS -o /tmp/seed.php https://raw.github.../scripts/prod-seed-stage5.php"
  echo "   php8.3 ~/bin/wp-cli.phar --path=PATH eval-file /tmp/seed.php"
  exit 1
fi

DOCROOT=""
for d in "~/дом-эксперт_рф/public_html" "~/public_html"; do
  if ssh "$SSH_USER@$SSH_HOST" "[ -d $d ]" 2>/dev/null; then
    DOCROOT="$d"
    break
  fi
done
if [ -z "$DOCROOT" ]; then echo "Cannot find production docroot" >&2; exit 1; fi
WP_CLI="php8.3 ~/bin/wp-cli.phar --path=$DOCROOT"

echo "=== Stage 5 seed for $DOCROOT ==="
ASSETS_DIR="$DOCROOT/wp-content/uploads/dom-expert-assets"
ssh "$SSH_USER@$SSH_HOST" "mkdir -p $ASSETS_DIR"
echo "--- rsyncing SVG assets from local Docker ---"
rsync -avz -e "ssh -o StrictHostKeyChecking=accept-new" \
  "$ROOT_DIR/local-env/wordpress/wp-content/uploads/dom-expert-assets/" \
  "$SSH_USER@$SSH_HOST:$ASSETS_DIR/"
echo "Assets synced."

echo "--- Seeding PHP script to production ---"
scp "$ROOT_DIR/scripts/prod-seed-stage5.php" "$SSH_USER@$SSH_HOST:/tmp/prod-seed-stage5.php"

echo "--- Running seed via wp-cli ---"
ssh "$SSH_USER@$SSH_HOST" "$WP_CLI eval-file /tmp/prod-seed-stage5.php"

echo "--- Cache flush, rewrite ---"
ssh "$SSH_USER@$SSH_HOST" "$WP_CLI cache flush --quiet; $WP_CLI rewrite flush --quiet; $WP_CLI plugin activate pods 2>/dev/null || true"

echo "=== Done ==="
