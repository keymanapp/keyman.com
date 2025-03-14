#!/usr/bin/env bash

THIS_SCRIPT="$(readlink -f "${BASH_SOURCE[0]}")"
THIS_SCRIPT_PATH="$(dirname "$THIS_SCRIPT")"

if [[ ! $1 =~ "debug" ]]; then
  echo "---- Generating CDN ---"
  rm -rf "$THIS_SCRIPT_PATH/../cdn/deploy"
  cd "$THIS_SCRIPT_PATH/../cdn"
  php -d include_path=/var/www/html/_includes:. cdnrefresh.php
  cd ..
else
  echo "Skip Generating CDN and clean CDN cache"
  rm -rf "$THIS_SCRIPT_PATH/../cdn/deploy"
fi
