#!/usr/bin/env bash
## START STANDARD SITE BUILD SCRIPT INCLUDE
readonly THIS_SCRIPT="$(readlink -f "${BASH_SOURCE[0]}")"
readonly BOOTSTRAP="$(dirname "$THIS_SCRIPT")/resources/bootstrap.inc.sh"
readonly BOOTSTRAP_VERSION=v1.08
[ -f "$BOOTSTRAP" ] && source "$BOOTSTRAP" || source <(curl -H "Cache-Control: no-cache" -fs https://raw.githubusercontent.com/keymanapp/shared-sites/$BOOTSTRAP_VERSION/bootstrap.inc.sh)
## END STANDARD SITE BUILD SCRIPT INCLUDE

readonly KEYMAN_CONTAINER_NAME=keyman-website
readonly KEYMAN_CONTAINER_DESC=keyman-com-app
readonly KEYMAN_IMAGE_NAME=keyman-website
readonly HOST_KEYMAN_COM=keyman.com.localhost

source _common/keyman-local-ports.inc.sh
source _common/docker.inc.sh

################################ Main script ################################

builder_describe \
  "Setup keyman.com site to run via Docker." \
  configure \
  clean \
  build \
  start \
  stop \
  test \

builder_parse "$@"

function test_docker_container() {
  # Note: ci.yml replicates these

  echo "TIER_TEST" > tier.txt
  set +e;
  set +o pipefail;

  builder_echo blue "---- PHP unit tests"
  docker exec $KEYMAN_CONTAINER_DESC sh -c "vendor/bin/phpunit --testdox"

  # Lint .php files for obvious errors
  builder_echo blue "---- Lint PHP files"
  docker exec $KEYMAN_CONTAINER_DESC sh -c "find . -name '*.php' | grep -v '/vendor/' | xargs -n 1 -d '\\n' php -l"

  # NOTE: link checker runs on host rather than in docker image
  builder_echo blue "---- Testing links"
  npx broken-link-checker http://localhost:8053/_test --recursive --ordered ---host-requests 50 -e --filter-level 3 --exclude '*/donate' | tee blc.log
  local BLC_RESULT=${PIPESTATUS[0]}
  echo ----------------------------------------------------------------------
  echo Link check summary
  echo ----------------------------------------------------------------------
  cat blc.log | \
    grep -E "BROKEN|Getting links from" | \
    grep -B 1 "BROKEN";

  builder_echo blue "Done checking links"
  rm tier.txt
  return "${BLC_RESULT}"
}

builder_run_action configure  bootstrap_configure
builder_run_action clean      clean_docker_container $KEYMAN_IMAGE_NAME $KEYMAN_CONTAINER_NAME
builder_run_action stop       stop_docker_container  $KEYMAN_IMAGE_NAME $KEYMAN_CONTAINER_NAME
builder_run_action build      build_docker_container $KEYMAN_IMAGE_NAME $KEYMAN_CONTAINER_NAME $BUILDER_CONFIGURATION
builder_run_action start      start_docker_container $KEYMAN_IMAGE_NAME $KEYMAN_CONTAINER_NAME $KEYMAN_CONTAINER_DESC $HOST_KEYMAN_COM $PORT_KEYMAN_COM $BUILDER_CONFIGURATION

builder_run_action test       test_docker_container
