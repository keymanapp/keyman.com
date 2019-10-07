<?php
  require_once('includes/template.php');
  
  // Required
  head([
    'title' =>'Keyman Desktop ' . $stable_version,
    'css' => ['template.css','index.css','desktop.css','feature-grid.css'],
    'showMenu' => true,
    'banner' => [
      'title' => 'Keyman Desktop <?php echo $stable_version; ?><br/><span id="title-small">Type in your language</span>',
      'button' => '<div id="banner-buttons"><a class="banner-button" href="download.php"><img src="'.cdn('img/download_button.png').'" /></a></div>',
      'image' => 'osk1.png',
      'background' => 'water'
    ]
  ]);
?>
<br/>
<h2 class="red underline">Introducing Keyman Desktop <?php echo $stable_version; ?></h2>
<p>
    With keyboards for over 1000 languages, Keyman Desktop lets you type in your language even when Windows doesn't. You can even create your own custom keyboards with <a href="/developer/">Keyman Developer <?php echo $stable_version; ?></a>.
</p>
<p>
    Our unique virtual keyboard technology makes it easy to type in all your programs, including Microsoft Office, Adobe Creative Suite, internet browsers and more, as well as supporting the latest version of Windows. 
</p>
<p>
    With over 20 years of development history, Keyman Desktop <?php echo $stable_version; ?> is the easiest and most efficient version to use we've ever built.
    And now that Keyman is free, we've completely removed any obstacles from getting you typing right away.
</p>
<ul>
  <li><a href="features.php">See the features</a></li>
  <li><a href="keyboards.php">Clever keyboards</a></li>
</ul>
<div class="button-div">
    <a href="<?php echo $dl9Link; ?>"><img src="<?php echo cdn('img/download_button.png'); ?>" /></a>
</div>

<?php
    if (betaTier()) {
?>
        <p>Want to try the Keyman Desktop <?php echo $beta_version ?> Beta? <a href="/<?= $beta_version ?>/">Learn more</a></p>
<?php
    }
?>

<h2 class="red underline">Features</h2>
<p>
    Keyman is now free and open source.
</p>
<table class='feature-grid'>
    <thead>
        <tr>
            <th>Feature</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><a href="features.php#keyboard-list">World-leading input methods for thousands of languages</a></td>
            <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
        </tr>
        <tr>
            <td><a href="features.php#keyman-dev">Create your own custom keyboards</a></td>
            <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
        </tr>
        <tr>
            <td>Start on Windows Login option</td>
            <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
        </tr>
        <tr>
            <td><a href="features.php#keyboard-limit">Number of keyboards you can install</a></td>
            <td>Unlimited</td>
        </tr>
        <tr>
            <td><a href="features.php#language-association">Associate keyboards with multiple languages</a></td>
            <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
        </tr>
        <tr>
            <td><a href="features.php#keyboard-information">Advanced keyboard information</a></td>
            <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
        </tr>
        <tr>
            <td><a href="features.php#hotkeys">Keyboard hotkeys</a></td>
            <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
        </tr>
        <tr>
            <td><a href="features.php#hotkeys">Interface hotkeys</a></td>
            <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
        </tr>
        <tr>
            <td><a href="features.php#language-switcher">Language switcher</a></td>
            <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
        </tr>
        <tr>
            <td><a href="features.php#language-switcher">Global language switch</a></td>
            <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
        </tr>
        <tr>
            <td><a href="features.php#character-map">Character Map tool</a></td>
            <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
        </tr>
        <tr>
            <td><a href="features.php#font-helper">Font helper tool</a></td>
            <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
        </tr>
        <tr>
            <td><a href="features.php#character-map">Character Identifier tool</a></td>
            <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
        </tr>
        <tr>
            <td>Hide startup screen</td>
            <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
        </tr>
        <tr>
            <td><a href="features.php#osk">Basic On-Screen Keyboard</a></td>
            <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
        </tr>
        <tr>
            <td><a href="features.php#osk">Advanced On-Screen Keyboard</a></td>
            <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
        </tr>
        <tr>
            <th>Technical Support Options</th>
            <th></th>
        </tr>
        <tr>
            <td><a href="features.php#support">Web-based Community Technical Support</a></td>
            <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
        </tr>
    </tbody>
</table>
<p>
    You can learn about all the features of Keyman Desktop <?php echo $stable_version; ?> by <a href="features.php">clicking here!</a>
</p>
<div class="button-div">
    <a href="<?php echo $dl9Link; ?>"><img src="<?php echo cdn('img/download_button.png'); ?>" /></a>
</div>
<h2 class="red underline">Frequently Asked Questions</h2>
<p>
    <span class="red">Q.</span> Is Keyman really free?
</p>
<p>
    <span class="red">A.</span> <a href="../free">Yes</a> it is!
</p>
<br/>
<p>
    <span class="red">Q.</span> What versions of Windows will Keyman <?php echo $stable_version; ?> work with?
</p>
<p>
    <span class="red">A.</span> Keyman Desktop <?php echo $stable_version; ?> is compatible with Windows 7, 8, 8.1, 10 and Server 2008, 2008 R2, 2012 and 2012 R2. If you're using an older version of Windows, Keyman Desktop 8.0 is still available for download at our archive page <a href="/downloads/archive/">here</a>.
</p>
<br/>
<p>
    <span class="red">Q.</span> What languages does Keyman support?
</p>
<p>
    <span class="red">A.</span> The short answer is a lot! With keyboards for over 1000 languages, there's a very good chance we have yours covered. You can search for a keyboard for your language <a href="/keyboards/">here</a>. If we don't already have a keyboard available, you can use <a href="/developer/">Keyman Developer <?php echo $stable_version; ?></a> to build one!
</p>
<br/>
<p>
    <span class="red">Q.</span> Should I upgrade my older version of Keyman Desktop?
</p>
<p>
    <span class="red">A.</span> Unless you are using Windows Vista or older version of Windows, we recommend that you upgrade to version <?php echo $stable_version; ?>.
</p>
<br/>
<p>
    <span class="red">Q.</span> Are Keyman Desktop 11.0, 10.0, 9.0, 8.0 and 7.1 still available for download?
</p>
<p>
    <span class="red">A.</span> Yes, you can find the links to download Keyman Desktop 11.0, 10.0, 9.0, 8.0 and 7.1 <a href="/archive/downloads.php">here</a>.
</p>
<br/>
