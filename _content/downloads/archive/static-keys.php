<?php
  function render_static_keys($links) {
    $keys = [
      "Keyman Desktop 9.0 (Pro)" => ["BUES-NJBK-3UZW-S3AB-9VNF", "keyman:activate?code=BUES-NJBK-3UZW-S3AB-9VNF"],
      "Keyman Developer 9.0" => ["AVFT-PB54-CFRJ-NF67-DR67", ""],
      "Keyman Desktop 8.0 (Pro)" => ["HWCY-LYT2-PKJ5-8ZQR-T74B", "keyman:activate?code=HWCY-LYT2-PKJ5-8ZQR-T74B"],
      "Keyman Developer 8.0" => ["GXDZ-MZ9P-XS8J-PE76-CQD6", ""],
      "Keyman Desktop 7.1 Light" => ["FYAW-JWRJ-RDHP-JB23-HMJB", ""],
      "Keyman Desktop 7.1 Pro" => ["EZBX-KFP4-YAJS-X677-DRLV", ""],
      "Keyman 6.2" => ["Name: Keyman<br/>Company: Keyman<br/>Licence No: K0300-1406-7831<br/>Reg Key: TS-Keyman-8341-B62F", ""]
    ];
?>

<table class='feature-grid'>
  <thead>
    <tr><th>Version</th><th>Key</th></tr>
  </thead>
  <tbody>

<?php
    foreach($keys as $product => $key) {
      if($links && $key[1])
        echo "<tr><td>$product</td><td><a style='text-decoration:underline' href='{$key[1]}'>{$key[0]}</a></td></tr>";
      else
        echo "<tr><td>$product</td><td>{$key[0]}</td></tr>";
    }
?>
  </tbody>
</table>
<?php
  }
?>