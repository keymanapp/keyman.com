<?php
  require_once __DIR__ . '/../_includes/autoload.php';
  use Keyman\Site\Common\KeymanHosts;

  echo "<p>TIER: " . KeymanHosts::Instance()->Tier() . "</p>";

  echo "<p><a href='./alive'>Alive</a></p>";
  echo "<p><a href='./ready'>Ready</a></p>";

?>
<table border=1>
  <thead><tr><th>Site</th><th>Backend URL</th><th>Frontend URL</th></thead>
  <tbody>
    <tr>
      <td>api.keyman.com</td>
      <td><?= KeymanHosts::Instance()->SERVER_api_keyman_com ?></td>
      <td><?= KeymanHosts::Instance()->api_keyman_com ?></td>
    </tr>
    <tr>
      <td>help.keyman.com</td>
      <td><?= KeymanHosts::Instance()->SERVER_help_keyman_com ?></td>
      <td><?= KeymanHosts::Instance()->help_keyman_com ?></td>
    </tr>
    <tr>
      <td>keyman.com</td>
      <td><?= KeymanHosts::Instance()->SERVER_keyman_com ?></td>
      <td><?= KeymanHosts::Instance()->keyman_com ?></td>
    </tr>
    <tr>
      <td>keymanweb.com</td>
      <td><?= KeymanHosts::Instance()->SERVER_keymanweb_com ?></td>
      <td><?= KeymanHosts::Instance()->keymanweb_com ?></td>
    </tr>
    <tr>
      <td>s.keyman.com</td>
      <td><?= KeymanHosts::Instance()->SERVER_s_keyman_com ?></td>
      <td><?= KeymanHosts::Instance()->s_keyman_com ?></td>
    </tr>
  </tbody>
</table>
