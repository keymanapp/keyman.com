<?php

  // TODO refactor away $site_url
  $site_url = 'keyman.com';

  class KeymanHosts {
    // Three tiers: development = x.keyman.com.local
    // Staging = staging.x.keyman.com
    // Production = x.keyman.com
    const TIER_DEVELOPMENT = "TIER_DEVELOPMENT";
    const TIER_STAGING = "TIER_STAGING";
    const TIER_PRODUCTION = "TIER_PRODUCTION";

    public $s_keyman_com, $api_keyman_com, $help_keyman_com, $downloads_keyman_com, $keyman_com, $keymanweb_com, $r_keymanweb_com;

    private $tier;

    public function Tier() {
      return $this->tier;
    }

    function __construct() {
      if(isset($_SERVER['KEYMANHOSTS_TIER']) && in_array($_SERVER['KEYMANHOSTS_TIER'], [KeymanHosts::TIER_STAGING, KeymanHosts::TIER_PRODUCTION])) {
        $this->tier = $_SERVER['KEYMANHOSTS_TIER'];
        $site_suffix = '';
        $site_protocol = 'https://';
      } else {
        $this->tier = KeymanHosts::TIER_DEVELOPMENT;
        $site_suffix = '.local';
        $site_protocol = 'http://';
      }

      if($this->tier == KeymanHosts::TIER_STAGING) {
        // As we build more staging areas, change these over as well. Assumption that we'll stage across multiple sites is a
        // little presumptuous but we can live with it.
        $this->s_keyman_com = "https://s.keyman.com";
        $this->api_keyman_com = "https://staging-api-keyman-com.azurewebsites.net";
        $this->help_keyman_com = "https://help.keyman.com";
        $this->downloads_keyman_com = "https://downloads.keyman.com";
        $this->keyman_com = "https://staging-keyman-com.azurewebsites.net";
        $this->keymanweb_com = "https://keymanweb.com";
        $this->r_keymanweb_com = "https://r.keymanweb.com";
      } else {
        // TODO: allow override of these with e.g. KEYMANHOSTS_API_KEYMAN_COM='https://api.keyman.com';
        $this->s_keyman_com = "{$site_protocol}s.keyman.com{$site_suffix}";
        $this->api_keyman_com = "{$site_protocol}api.keyman.com{$site_suffix}";
        $this->help_keyman_com = "{$site_protocol}help.keyman.com{$site_suffix}";
        $this->downloads_keyman_com = "{$site_protocol}downloads.keyman.com{$site_suffix}";
        $this->keyman_com = "{$site_protocol}keyman.com{$site_suffix}";
        $this->keymanweb_com = "{$site_protocol}keymanweb.com{$site_suffix}";
        $this->r_keymanweb_com = "https://r.keymanweb.com"; /// local dev domain is usually not available
      }
    }
  }

  $KeymanHosts = new KeymanHosts();
