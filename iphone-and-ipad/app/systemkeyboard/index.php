<?php
session_start();
require_once('includes/servervars.php');
?>
<!DOCTYPE html>

<html>
<head>
    <title>Keyman for iPhone and iPad Information Page</title>
    <meta content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" name="viewport">
    <link rel="stylesheet" type="text/css" href="<?php echo cdn("css/app-info.css"); ?>" />
    <?php require_once('includes/analytics.php'); ?>
</head>

<body>
    <div class="wrapper">
        <h2>Installing System-Wide Keyboards</h2>
        <br/>
        <p>
            Step 1) Open the 'Settings' App and go to 'General' > 'Keyboard'
        </p>
        <img src="<?php echo cdn("img/app/keyman-settings5.png"); ?>" />
        <p>
            Step 2) Touch 'Keyboards'
        </p>
        <img src="<?php echo cdn("img/app/keyman-settings6.png"); ?>" />
        <p>
            Step 3) Touch 'Add New Keyboard...'
        </p>
        <img src="<?php echo cdn("img/app/keyman-settings.png"); ?>" />
        <br/><br/>
        <p>
            Step 4) Touch 'Keyman' under THIRD-PARTY KEYBOARDS.
        </p>
        <img src="<?php echo cdn("img/app/keyman-settings2.png"); ?>" />
        <br/><br/>
        <p>
            Step 5) Touch 'Keyman - Keyman'.
        </p>
        <img src="<?php echo cdn("img/app/keyman-settings3.png"); ?>" />
        <br/><br/>
        <p>
            Step 6) Turn on the 'Allow Full Access' toggle and confirm.
        </p>
        <img src="<?php echo cdn("img/app/keyman-settings4.png"); ?>" />
        <br/><br/>
        <p>
            Your Keyman keyboards will now be available throughout your entire device. You can switch between Keyman keyboards and the default iOS keyboard layout by touching the globe key of the keyboard whenever you are typing.
        </p>
        <img src="<?php echo cdn("img/app/globe.png"); ?>" />
    </div>
</body>
</html>
