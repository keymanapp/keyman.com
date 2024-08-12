<?php
  require_once('includes/template.php');
  require_once('includes/ui/downloads.php');

  // Required
  head([
    'title' =>'Keyman All Versions',
    'css' => ['template.css','index.css', 'app-store-links.css','prism.css'],
    'showMenu' => true
  ]);
?>
<script src='<?=cdn('js/clipboard.min.js')?>'></script>
<script src='<?=cdn('js/prism.js')?>'></script>

<h2 class="red underline large">Keyman All Versions</h2>

<?php
$data = json_decode(file_get_contents('https://downloads.keyman.com/api/version/all'));

if ($data === NULL) {
    die('Error decoding JSON data.');
}
?>

<div id ="version-container">
  <?php
  // Iterate over each version in the data
  foreach ($data as $version => $types) {
      echo '<div class="version-row">';
      echo '<h3>' . htmlspecialchars($version) . '</h3>';
      
      // Iterate over each type (alpha, beta, stable)
      foreach ($types as $type => $versions) {
          echo '<div class="version-type">';
          echo  '<h4>' . htmlspecialchars(ucfirst($type)) . '</h4><br>';
          
          // Check if there are versions for this type
          if (empty($versions)) {
            echo '<h5>Not available yet</h5>'; 
          } else {
              // Create links for each version
              foreach ($versions as $ver) {
                  echo '<br><div class="version-item"><a href="../releases/' . urlencode($ver) . '">' . htmlspecialchars($ver) . '</a></div>'; 
              }
          }
          
          echo '</div>';
      }
      
      echo '</div>';
  }
  ?>
</div>
