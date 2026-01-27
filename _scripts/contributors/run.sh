#!/usr/bin/env bash

set -eu

readonly THIS_SCRIPT="$(readlink -f "${BASH_SOURCE[0]}")"
readonly THIS_SCRIPT_PATH="$(dirname "$THIS_SCRIPT")"
cd "${THIS_SCRIPT_PATH}"

if [[ -z "${GITHUB_TOKEN+x}" ]] || [[ -z "${CROWDIN_TOKEN+x}" ]]; then
  echo "_scripts/contributors/runs.sh: generates contributors.md and pushes to GitHub"
  echo
  echo "* GITHUB_TOKEN and CROWDIN_TOKEN variables must be set in order to run this script"
  echo
  echo "* This script normally runs automatically as part of a GitHub Action, but if run"
  echo "  manually, will skip the git commit + push step and just generate contributors.md."
  exit 1
fi

npm ci
node . -g "${GITHUB_TOKEN}" -c "${CROWDIN_TOKEN}" -o "../../about/developers/contributors.md"

if [[ -z "${GITHUB_ACTIONS+x}" ]]; then
  echo "Skipping git commit because of local run"
else
  if ! git diff --exit-code -- ../../about/developers/contributors.md; then
    git config user.email server@keyman.com
    git config user.name "Keyman Server"
    git switch -c auto/contributors
    git add ../../about/developers/contributors.md
    git commit -m "auto: refresh contributors.md

  Test-bot: skip"
    git push -u origin auto/contributors
    gh pr create --fill
  fi
fi