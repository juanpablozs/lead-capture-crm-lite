#!/usr/bin/env bash
set -euo pipefail
ROOT_DIR="$(cd "$(dirname "$0")/.." && pwd)"

echo "Starting Docker environment (WordPress + MySQL)..."
docker compose up -d

echo "Waiting for WordPress to be available on http://localhost:8000 ..."
for i in {1..60}; do
  if curl -sSf http://localhost:8000 >/dev/null 2>&1; then
    echo "WordPress is responding"
    break
  fi
  echo "Waiting... ($i)"
  sleep 2
done

# Install or verify WordPress core (using wordpress container and WP-CLI phar)
# We use `docker compose exec` so the command runs with the same PHP/extensions as the webserver.
docker compose exec wordpress bash -lc '
  if [ ! -f /usr/local/bin/wp ]; then
    echo "Downloading WP-CLI phar into wordpress container..."
    curl -sS https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar -o /usr/local/bin/wp && chmod +x /usr/local/bin/wp
  fi

  if /usr/local/bin/wp --allow-root --path=/var/www/html core is-installed >/dev/null 2>&1; then
    echo "WordPress already installed"
  else
    echo "Installing WordPress (WP-CLI)..."
    /usr/local/bin/wp --allow-root --path=/var/www/html core install --url="http://localhost:8000" --title="LCC Local" --admin_user="admin" --admin_password="password" --admin_email="admin@example.test" --path=/var/www/html
  fi
'

# Install composer dependencies
echo "Installing PHP dependencies (composer)..."
docker compose run --rm php composer install --working-dir=/app/lead-capture-crm-lite --no-interaction --prefer-dist

# Build JS assets
echo "Building JS assets (npm)..."
docker compose run --rm node bash -lc "cd /app/lead-capture-crm-lite && npm ci && npm run build"

# Activate plugin
echo "Activating plugin..."
# Use WP-CLI inside the wordpress container to activate the plugin
docker compose exec wordpress bash -lc "/usr/local/bin/wp --allow-root --path=/var/www/html plugin activate lead-capture-crm-lite || true"

echo "Done. You can open http://localhost:8000 and login with admin/password"
