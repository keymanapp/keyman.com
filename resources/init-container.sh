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

echo "---- Generating .mo localization files ----"
cd _includes/locale/en/LC_MESSAGES/

# cleanup previous .mo files
find . -type f -name '*.mo' -delete

# Compile .po to .mo localization files
for filename in `find . -type f -name "*.po"`; do
  # Remove the .po extension
  base_name=`echo ${filename} | sed 's/\.[^.]*$//'`
  msgfmt "${base_name}.po" --output-file="${base_name}".mo
  retVal=$?
  if [[ ${retVal} -ne 0 ]]; then
    exit 1
  fi
done
