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
# PHP localization strings need to have '$' escaped like '%1\$s'.
# But the download files from Crowdin get escaped again as '%1\\$s'. 
# Reverts to escaping once.
cd "$THIS_SCRIPT_PATH/../_includes/locale/strings"

find . -type f -name "*.php" -print0 | while IFS= read -r -d '' file; do
  # Not doing sed in-place to avoid permission errors
  sed -r 's/([0-9])\\{2}\$/\1\\\$/g' "$file" > temp

  if [ $? -ne 0 ]; then
    echo "ERROR cleaning up files: $file"
    exit 1
  fi

  mv temp "$file"

done
