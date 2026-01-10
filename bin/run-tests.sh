#!/usr/bin/env bash
set -euo pipefail

echo "Installing PHP dependencies (composer)..."
# Fix Git 'dubious ownership' and allow composer plugin composer/installers
docker compose run --rm php bash -lc 'git config --global --add safe.directory /app || true; cd /app/lead-capture-crm-lite && composer config --no-plugins allow-plugins.composer/installers true && composer install --no-interaction --prefer-dist'

echo "Starting DB container..."
docker compose up -d db

PORT=${LCC_PORT:-8000}

echo "Checking if WordPress is reachable on http://localhost:$PORT ..."
if curl -sSf http://localhost:$PORT >/dev/null 2>&1; then
  # If the wordpress container belongs to this compose project we can exec into it. Otherwise start ours on next port.
  if [ -n "$(docker compose ps -q wordpress 2>/dev/null || true)" ] && [ "$(docker inspect -f '{{.State.Running}}' $(docker compose ps -q wordpress 2>/dev/null || true))" = "true" ]; then
    echo "WordPress already running in this compose project"
  else
    NEXT_PORT=$((PORT+1))
    echo "Port $PORT occupied by another process; starting our WordPress on port $NEXT_PORT"
    export LCC_PORT=$NEXT_PORT
    docker compose up -d wordpress
    PORT=$NEXT_PORT
  fi
else
  echo "Starting WordPress container..."
  docker compose up -d wordpress
fi

echo "Ensuring WordPress tests library is available inside wordpress container..."
docker compose exec wordpress bash -lc '
  set -euo pipefail
  if [ ! -d /tmp/wordpress-tests-lib ]; then
    echo "Attempting to download wordpress-tests-lib tarball (codeload)..."
    URLS=(
      "https://codeload.github.com/WordPress/wordpress-tests-lib/tar.gz/master"
      "https://github.com/WordPress/wordpress-tests-lib/archive/refs/heads/master.tar.gz"
    )

    TMP_TAR=/tmp/wordpress-tests-lib.tar.gz
    SUCCESS=0
    for u in "${URLS[@]}"; do
      echo "Trying $u"
      if curl -sS -L -f "$u" -o "$TMP_TAR"; then
        # Quick sanity check
        if tar -tzf "$TMP_TAR" >/dev/null 2>&1; then
          mkdir -p /tmp/wordpress-tests-lib
          tar -xzf "$TMP_TAR" -C /tmp/wordpress-tests-lib --strip-components=1
          SUCCESS=1
          break
        else
          echo "Downloaded file is not a valid gzip tarball (url: $u)" >&2
        fi
      else
        echo "Download failed for $u" >&2
      fi
    done

    if [ "$SUCCESS" -eq 0 ]; then
      echo "Falling back to git clone (non-interactive)..."
      # Try cloning with no prompting; if GitHub blocks auth, this will fail quickly
      GIT_QUIET=1
      if command -v git >/dev/null 2>&1; then
        GIT_TERMINAL_PROMPT=0 git clone --depth=1 https://github.com/WordPress/wordpress-tests-lib.git /tmp/wordpress-tests-lib || { echo "git clone failed" >&2; exit 1; }
      else
        echo "git not available inside container; aborting" >&2
        exit 1
      fi
    fi
  else
    echo "wordpress-tests-lib already exists"
  fi
'

echo "Running PHPUnit tests (inside wordpress container)..."
docker compose exec -T wordpress bash -lc "cd /var/www/html/wp-content/plugins/lead-capture-crm-lite && WP_TESTS_DIR=/tmp/wordpress-tests-lib php vendor/bin/phpunit -c tests/phpunit.xml"
