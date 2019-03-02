<?php
require_once('includes/template.php');

    // Required
    head([
        'title' =>'Help for Keyman Issue',
        'css' => ['template.css'],
        'showMenu' => true
    ]);

    $IssueID = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
?>

<h2 class="red underline">Getting Help for Keyman Issue <?php echo $IssueID ?></h2>

<p>
    We are sorry for any inconvenience caused with this crash in Keyman, and we appreciate your feedback because it
    helps our developers improve the stability of the Keyman products.
</p>

<p>
    If you feel blocked by this particular issue, please write about it on our
    <a href='https://community.software.sil.org/c/keyman'>Keyman Community Site</a>.
    Another user or Keyman developer may be able to suggest a workaround / solution to your problem.
</p>
<br/>

<h3>Guidelines To Create a Useful Topic</h3>
<p>
    The more information that you can include regarding this issue with Keyman, the easier it will be for others to assist you. Make sure you include:
</p>

<ul>
    <li>the language / keyboard you are working with</li>
    <li>the type of device</li>
    <li>version of the operating system</li>
    <li>version of the Keyman application or app you are using</li>
</ul>

<p>
    <strong class="red">Don&apos;t</strong> include private or personal details because the forum is public.
</p>

<h2 class="red underline">Online Community</h2>
<p>
    <a href="https://twitter.com/keyman"><img class="contact-social" src="<?php echo cdn("img/twitter2.png"); ?>"/>Twitter</a>
    <br/>
    <a href="https://www.facebook.com/KeymanApp"><img class="contact-social" src="<?php echo cdn("img/facebook2.png"); ?>"/>Facebook</a>
</p>

