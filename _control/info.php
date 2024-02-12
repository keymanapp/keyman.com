<?php
  require_once __DIR__ . '/../_includes/autoload.php';
  use Keyman\Site\Common\KeymanHosts;

  echo "<p>TIER: " . KeymanHosts::Instance()->Tier() . "</p>";
