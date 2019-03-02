<?php
  require_once('includes/template.php');
  
  if(isset($_REQUEST['id'])){
    $UninstallID = $_REQUEST['id'];
  }
  if(isset($_REQUEST['token'])){
    $Token = $_REQUEST['token'];
  }
  
  
  // Required
  head([
    'title' =>'Uninstall Feedback | Keyman',
    'css' => ['template.css'],
    'showMenu' => false,
    'foot' => false
  ]);           
?>
<h1>Uninstall Feedback</h1>
<?php if(isset($_REQUEST['msg']) && $_REQUEST['msg'] == 'Your feedback was successfully sent'){ echo '<div id="feedback-msg">'.$_REQUEST['msg'].'!</div>';}else{ ?>
<p class="center" id="uninstall-question">Thank you for using Keyman, can you help us improve the product? What is your primary reason for uninstalling?</p>
<div id="uninstall-feedback-buttons">
  <button class="feedback" value="nokeyboard">
    I couldn't find a keyboard for my language
  </button>
  <button class="feedback" value="reconfigure">
    Reinstalling or reconfiguring
  </button>
  <button class="feedback" value="move">
    Moving to a new computer
  </button>
  <button class="feedback" value="alternative">
    Using a different product
  </button>
  <button class="feedback" value="price">
    Pricing
  </button>
  <button class="feedback" value="problems">
    Bug or Problem using Keyman
  </button>
  <button class="feedback" value="other">
    Another reason
  </button>
</div>
<div id="feedback-msg2"></div>
<form id="feedback-message" action="/prog/uninstall2.php" method="POST">
  <p class="center">Thank you for your feedback. If you'd like to provide further details, please fill out the form below. Please note that you won't receive a response to this feedback; you are 
  always welcome to contact the <a href='https://community.software.sil.org/c/keyman'>SIL Keyman Community</a> if you have additional feedback.</p>
  <br/>
  <input type="hidden" id="feedback-reason" name="Reason" />
  <input type="hidden" id="uninstallID" name="UninstallID" value="<?php echo $UninstallID; ?>" />
  <input type="hidden" id="token" name="Token" value="<?php echo $Token; ?>" />
  <label for="description">Comment:
      <textarea name="Description" id="feedback-description" ></textarea>
  </label>
  <br/>
  <div id="feedback-submit">
      <input type='submit' value='Submit Feedback' />
  </div>
</form>
<p>&nbsp;</p>
<p class="center" id="reinstall">
  If you would like to reinstall Keyman Desktop, you can do so <a href='/desktop/download.php'>here</a>.
</p>
<?php } ?>