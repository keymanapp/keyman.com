#!/usr/bin/env bash
## START STANDARD SITE BUILD SCRIPT INCLUDE
readonly THIS_SCRIPT="$(readlink -f "${BASH_SOURCE[0]}")"
readonly BOOTSTRAP="$(dirname "$THIS_SCRIPT")/resources/bootstrap.inc.sh"
readonly BOOTSTRAP_VERSION=v1.0.3
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
  # TODO: lint tests
  echo "TIER_TEST" > tier.txt
  echo "---- Testing links ----"
  set +e;
  set +o pipefail;
  npx broken-link-checker http://localhost:8053/_test --recursive --ordered ---host-requests 50 -e --filter-level 3 --exclude '*/donate' | \
    grep -E "BROKEN|Getting links from" | \
    grep -B 1 "BROKEN";

  echo "Done checking links"
  rm tier.txt
}

builder_run_action configure  bootstrap_configure
builder_run_action clean      clean_docker_container $KEYMAN_IMAGE_NAME $KEYMAN_CONTAINER_NAME
builder_run_action stop       stop_docker_container  $KEYMAN_IMAGE_NAME $KEYMAN_CONTAINER_NAME
builder_run_action build      build_docker_container $KEYMAN_IMAGE_NAME $KEYMAN_CONTAINER_NAME
builder_run_action start      start_docker_container $KEYMAN_IMAGE_NAME $KEYMAN_CONTAINER_NAME $KEYMAN_CONTAINER_DESC $HOST_KEYMAN_COM $PORT_KEYMAN_COM $BUILDER_CONFIGURATION

builder_run_action test       test_docker_container
