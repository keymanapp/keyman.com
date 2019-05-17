<?php /*
  Name:             servervars
  Copyright:        Copyright (C) 2005 Tavultesoft Pty Ltd.
  Documentation:    
  Description:      
  Create Date:      17 Oct 2009

  Modified Date:    17 Oct 2009
  Authors:          mcdurdin
  Related Files:    
  Dependencies:     

  Bugs:             
  Todo:             
  Notes:            
  History:          17 Oct 2009 - mcdurdin - Alter help base dir
*/
  if(file_exists($_SERVER['DOCUMENT_ROOT'].'/cdn/deploy/cdn.php')) {
    require_once($_SERVER['DOCUMENT_ROOT'].'/cdn/deploy/cdn.php');
  }

  $site_url = 'keyman.com';

  // Major stable and beta versions
  global $stable_version_int, $beta_version_int;
  $stable_version_int = 11;
  $beta_version_int = 11;

  $stable_version = $stable_version_int . '.0';
  $beta_version = $beta_version_int . '.0';

  function betaTier() {
      global $stable_version_int, $beta_version_int;
      return $beta_version_int > $stable_version_int;
  }

  // We allow the site to strip off everything post its basic siteurl
  
  function GetHostSuffix() {
    global $site_url;
    $name = $_SERVER['SERVER_NAME'];
    if(stripos($name, $site_url.'.') == 0) {
      return substr($name, strlen($site_url), 1024);
    }
    return '';
  }
  
  $site_suffix = GetHostSuffix();
  $site_protocol = (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';
    
  if($site_suffix == '') {
    $TestServer = false;
   
    $site_tavultesoft = 'www.tavultesoft.com';
    $site_securetavultesoft = 'secure.tavultesoft.com';
    $buy9Link = "https://secure.tavultesoft.com/buy/90/";
    $dl9Link = "/desktop/download.php";
    $upgradeLink = "https://secure.tavultesoft.com/keyman/upgrade.php";
  } else {
    $TestServer = true;

    $site_tavultesoft = "tavultesoft.com{$site_suffix}";
    $site_securetavultesoft = $site_tavultesoft;

    $buy9Link = "http://tavultesoft.com{$site_suffix}/buy/90";
    $dl9Link = "/desktop/download.php";
    $upgradeLink = "http://tavultesoft.com{$site_suffix}/keyman/upgrade.php";
  }

  $staticDomain="s.keyman.com{$site_suffix}/kmc";
  $helpSite = "help.keyman.com{$site_suffix}";
  $resourceDomain="r.keymanweb.com{$site_suffix}";

  $statichost = "{$site_protocol}s.keyman.com{$site_suffix}";
  $apihost = "{$site_protocol}api.keyman.com"; //{$site_suffix}";
  $helphost = "{$site_protocol}help.keyman.com{$site_suffix}";
  $downloadhost = "{$site_protocol}downloads.keyman.com"; //{$site_suffix}"; <-- downloads.keyman.com.local is not usually available being a more complex setup
  $localhost = "{$site_protocol}keyman.com{$site_suffix}";
  $keymanwebhost = "{$site_protocol}keymanweb.com{$site_suffix}";
  $resourcehost = "https://r.keymanweb.com"; /// local dev domain is usually not available
  
  function cdn($file) {
    global $cdn, $staticDomain, $TestServer;
    $use_cdn = !$TestServer || (isset($_REQUEST['cdn']) && $_REQUEST['cdn'] == 'force');
    if($use_cdn) {
      if($cdn && isset($cdn['/'.$file])) {
        return "/cdn/deploy{$cdn['/'.$file]}";
      } /*else {
        error_log("Missing CDN file $file, see ".print_r($cdn, true), 1, 'marc@keyman.com', 'From: support@keyman.com');
      }*/
    }
    return "/cdn/dev/{$file}";
  }
?>