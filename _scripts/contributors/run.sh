#!/usr/bin/env bash

# assumes run from current folder

npm ci
node . -g "${GITHUB_TOKEN}" -c "${CROWDIN_TOKEN}" -o "../../about/contributors.md"
if ! git diff --exit-code -- ../../about/contributors.md; then
  git config user.email server@keyman.com
  git config user.name "Keyman Server"
  git switch -c auto/contributors
  git add ../../about/contributors.md
  git commit -m "auto: refresh contributors.md

Test-bot: skip"
  git push -u origin auto/contributors
  gh pr create --fill
fi