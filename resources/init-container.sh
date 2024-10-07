#!/usr/bin/env bash

if [[ ! $1 =~ "debug" ]]; then
  echo "---- Generating CDN ---"
  rm -rf cdn/deploy
  cd cdn
  php -d include_path=/var/www/html/_includes:. cdnrefresh.php
  cd ..
else
  echo "Skip Generating CDN and clean CDN cache"
  rm -rf cdn/deploy
fi
