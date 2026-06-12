# shellcheck shell=bash

# Record the start time for unit tests for later log review
function do_test_record_start_time() {
  TEST_START_TIME=$(date -Is -u)
}

# Run unit tests through phpunit
function do_test_unit_tests() {
  local CONTAINER="$1"
  docker exec "${CONTAINER}" sh -c "vendor/bin/phpunit --testdox"
}

# Lint .php files for obvious errors
function do_test_lint() {
  local CONTAINER="$1"
  docker exec "${CONTAINER}" sh -c "find . -name '*.php' | grep -v '/vendor/' | xargs -n 1 -d '\\n' php -l"
}

# Check links on live local server using linkinator
function do_test_links() {
  local baseURL="$1"

  # NOTE: link checker runs on host rather than in docker image
  local ignoreLocales baseURL

  # determine non-en locales to ignore
  ignoreLocales="$(jq -r 'keys | map(select(. != "en")) | join("|")' ./_includes/locale/locales.json)"

  set +e
  npx https://github.com/keymanapp/linkinator \
    "${baseURL}/_test" \
    --clean-urls \
    --concurrency 50 \
    --format json \
    --output-filename linkinator-results.json \
    --skip "^(?!${baseURL})" \
    --skip "^${baseURL}/(${ignoreLocales})" \
    --skip "^${baseURL}/en/downloads/releases/" \
    --recurse \
    --redirects verify \
    --retry-errors \
    --root-path "${baseURL}"
  local RESULT=$?
  set -e

  return "${RESULT}"
}

# Print summary of results from linkinator
function do_test_print_link_report() {
  echo ----------------------------------------------------------------------
  echo Link check summary
  echo ----------------------------------------------------------------------
  # Emit full JSON detail for broken links (may not be necessary)
  jq '.links[] | select(.state != "OK")' < linkinator-results.json
  echo
  echo
  # Emit a summary report
  jq -r '.links[] | select(.state != "OK") | "\(.state)[\(.status)]: \(.parent)   -->   \(.url)"' < linkinator-results.json
}

# Scan logs recorded on container since start of tests to find any reported PHP
# errors (note, depends on 'php7' string)
function do_test_print_container_error_logs() {
  local CONTAINER="$1"
  if docker container logs "${CONTAINER}" --since "${TEST_START_TIME}" 2>&1 | grep -q 'php7'; then
    echo 'PHP reported errors or warnings:'
    docker container logs "${CONTAINER}" --since "${TEST_START_TIME}" 2>&1 | grep 'php7'
    return 1
  else
    echo 'No PHP errors found'
    return 0
  fi
}
