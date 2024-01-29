<?php
  declare(strict_types=1);

  namespace Keyman\Site\com\keyman;

  use \Keyman\Site\Common\KeymanHosts;

  // Provides additional overrides of domain names for dev use. See /_common/KeymanHosts.php
  //class LocalEnv {  }

  $tiers = array(
    KeymanHosts::TIER_DEVELOPMENT, KeymanHosts::TIER_TEST, KeymanHosts::TIER_STAGING, KeymanHosts::TIER_PRODUCTION
  );

  $mapped_domains = array(
    // mapped from $tiers:                TIER_DEVELOPMENT           TIER_TEST                    TIER_STAGING                    TIER_PRODUCTION
    "keyman.com"           => array( "docker.host.internal:8053", "localhost:8053",               "keyman-staging.com",           "keyman.com"           ),
    "web.keyman.com"       => array( "web.keyman.com.localhost",  "localhost:8057",               "web.keyman-staging.com",       "web.keyman.com"       ),
    "api.keyman.com"       => array( "host.docker.internal:8058", "localhost:8058",               "api.keyman-staging.com",       "api.keyman.com"       ),
    "s.keyman.com"         => array( "s.keyman.com.localhost",    "localhost:8054",               "s.keyman-staging.com",         "s.keyman.com"         ),
    "help.keyman.com"      => array( "host.docker.internal:8055", "localhost:8055",               "help.keyman-staging.com",      "help.keyman.com"      ),
    "downloads.keyman.com" => array( "downloads.keyman.com",      "downloads.keyman-staging.com", "downloads.keyman-staging.com", "downloads.keyman.com" ),
  );
  
  $other_domains = array(
    // currently disabled
    "dev.keyman.com" => "keyman.dev",
    "keyman.dev" => "keyman.dev",
  
    // redirects and other services
    "keymanweb.com"  => "web.keyman.com",
  
    // Keyman Blog
    "keyman.blog" => "blog.keyman.com",
    "blog.keyman.com" => "blog.keyman.com",
  
    // legacy domains
    "keymankeyboards.com" => "keymankeyboards.com",
    "r.keymanweb.com" => "r.keymanweb.com",
    "tavultesoft.com" => "tavultesoft.com",
    "blog.tavultesoft.com" => "blog.tavultesoft.com",
  );
  
  // combine the two arrays of domains to make our single mapping, pseudocode
  
  
  if(file_exists(__DIR__ . '/../localenv.php')) {
    // get $override_domains (name could be better!)
    // TODO: names and locations
    require_once(__DIR__ . '/../localenv.php');
  }
  
  function getDomainMapping($tier) {
    $result = array();
    $tier_index = find_index_of($tier, $tiers);
    foreach($mapped_domains as $domain => $map) {
      $result[$domain] = $map[$tier_index];
    }
    foreach($other_domains as $domain => $map) {
      $result[$domain] = $map;
    }
  
    // allow for local overrides
    if(isset($override_domains)) {
      foreach($override_domains as $domain => $map) {
        $result[$domain] = $map;
      }
    }
    return $result;
  }
