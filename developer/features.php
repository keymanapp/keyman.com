<?php
  require_once('includes/template.php');

  // Required
  head([
    'title' => 'Features | Keyman Developer ' . $stable_version,
    'css' => ['template.css', 'dev.css', 'feature-template.css'],
    'showMenu' => true
  ]);
  require_once('includes/developer-features.php');
?>
<style>
    dl { font-size: 14pt; }
    dl dt { font-weight: bold; margin: 24px 0 16px 10px; }
    dl dd { margin: 16px 0 16px 24px; }
    #section2 dl dd p { padding:0; margin: 10px 0 10px 0; }
</style>

<div class="info-right">
  <div class="section" id="new">
    <h2 class="red underline">What's New</h2>
    <p>Keyman Developer embeds the open source <a href="https://microsoft.github.io/monaco-editor/">Monaco Editor</a>, the same editor
        in Microsoft Visual Studio Code. You can create and apply
        <a href="https://help.keyman.com/developer/11.0/reference/editor-themes">custom editor themes</a> to Keyman Developer.</p>
    <br/><br/>

    <h3 class="red">BCP 47 language tags</h3>
    <p>Use Keyman Developer to associate your Keyman keyboards with <a href="#bcp47-tags">BCP 47</a> language identifiers.</p>
    <br/><br/>

    <h3 class="red">Web-based testing</h3>
    <p>Touch keyboards can be developed and tested on your Windows desktop or laptop before you take them to your mobile device.</p>
    <p>From your mobile device, browse to your Keyboard Test Host and easily install the keyboard with a click of a button.</p>
    <p><img src='<?= cdn("img/developer-web-testing.png") ?>' alt="Developer web-based testing" /></p>
    <br/><br/>

    <h3 class="red">Improved Templates for New Projects</h3>
      <p>Create a keyboard project that matches the folder structure used in the Keyman
        <a href="https://github.com/keymanapp/keyboards/">keyboards repository</a>.
        Keyman Developer will create and include all the basic files needed for the project.</p>
    <img src='<?= cdn("img/developer-new-project.png"); ?>' alt="Developer New Project" />
    <br/><br/>

      <p>The new project wizard also allows you to import a Windows system keyboard as your keyboard project.</p>
    <img src='<?= cdn("img/developer-select-system-keyboard.png"); ?>' alt="Developer Select System Keyboard" />
    <br/><br/>

    <h3 class="red">Better modifier support across platforms</h3>
    <p>Visual editors now support keyboards that distinguish left and right ctrl/alt modifiers which
        you can also use for web and mobile targets.</p>
    <img src='<?= cdn("img/developer-right-alt.png"); ?>' alt="Developer right alt modifier" />
    <br/><br/>

  </div>

  <div class="section" id="keyboard">
    <h2 class="red underline">Keyboard Editor</h2>
    <p>The Keyboard Editor of Keyman Developer <?php echo $stable_version_int; ?> makes it easy to design any style of keyboard:</p>
    <br/><br/>

    <h3 class="red">Two Ways to Begin</h3>
    <ol>
      <li>
        1. Drag &amp; Drop Design: develop smart keyboards from the Layout page with the simplicity of drag &amp; drop.
        No technical expertise required.
      </li>
      <li>
        2. Work from the Source: use the Source page to craft enhanced keyboards, with constraints, dead keys, reordering,
        options and more.
        <br/>
        <img class='borderless' src='<?= cdn('img/keyboard-greek-torn.png') ?>' alt='Two Ways to Begin a Keyman Keyboard '/>
      </li>
    </ol>
    <br/><br/>

    <h3 class="red">Touch Layouts for Mobile Devices</h3>
    <p>Create separate touch layouts for iOS and Android devices. Add longpress combinations for keys
      so users can avoid impractical shift layers.</p>
    <p><img class='borderless' src='<?= cdn('img/touch_amharic_keyboard_8.png') ?>'
      alt='Touch layout for Amharic Keyboard' /></p>
    <br/><br/>

    <h3 class="red" id="bcp47-tags">BCP 47 language tags</h3>
    <p>Give your keyboard language and script tags for automatic Office and Windows language association.</p>
    <br/><br/>

    <h3 class="red">Taskbar Icon</h3>
    <p>Devise a taskbar icon that distinguishes your keyboard <br/>at a glance.</p>
    <p><img class='borderless' src='<?= cdn('/img/developer-edit-icon.png') ?>'
      alt='Developer includes an Icon editor'/></p>
    <br/><br/>

    <p><img class='borderless' src='<?= cdn('/img/keyman-kmw.png') ?>'
      alt='Create Keyboards for Keyman Desktop or KeymanWeb '/></p>
    <br/><br/>

    <hr />
    <p>Keyman Developer <?php echo $stable_version_int; ?> gives you a full set of expert features to let you build the
      most advanced possible keyboards:</p>
    <br/><br/>

    <h3 class="red">Smart Character Map</h3>
    <p>Fully Unicode 12.0: access every character in the newest version of the Unicode Standard from the Keyman Character
      Map. </p>
    <p>Double-Click Insert: insert over 136,000 letters and symbols with a double-click. Say goodbye to multi-step
      clipboard actions.</p>
    <p>Intelligent Search: With so many Unicode characters available, there's several ways to search and filter for the
        characters in your language: partial name match, by Unicode range, block, font, or code point,
        or using standard wildcards.</p>
    <p><img src='<?= cdn('/img/devcharmap.png') ?>' alt='The Keyman Character Map '/></p>
    <br/><br/>

    <h3 class="red">Robust Programming Language</h3>
    <p>Contextual Rules: write adaptive rules that change a key's output depending on the context.</p>
    <p>Character Stores: create character stores that let rules manage multiple letters at the same time.</p>
    <p>Rule Groups: build groups of rules to handle the same input differently in different situations.</p>
    <p>Options: construct temporary or saveable options that activate different rules and groups based on end-user
      selections.</p>
    <p><img class='borderless' src='<?= cdn('/img/code.png') ?>' alt="Keyman Developer Programming Examples "/></p>
    <p>Keys in Any Shift-State: remap almost any key in any combination of shift-states - Ctrl, Alt, Shift, Caps and
      AltGr.</p>
    <p>Multi-Character Output: set any key to output over 1,000 characters at once from anywhere in Unicode.</p>
    <p>Deadkeys &amp; Statements: define deadkeys that impact output without leaving a trace. Use over 20 other
      statements to shape precision rules.</p>
    <p>Two Layout Types: develop keyboards with fixed layouts or ones that shift to match a users' hardware.</p>
    <p><img class='borderless' src='<?= cdn('/img/code2.png') ?>' alt='Keyman Developer Programming Examples '/></p>
    <br/><br/>

    <h3 class="red">Complete Debugging Tools</h3>
    <p>In-Application Testing: test your keyboards in Keyman Developer without opening another program.</p>
    <p>Single-Step Mode: debug your keyboard rules line by line to find the exact cause of your keyboard problem.</p>
    <p>Regression Testing: write and save tests to run again on different systems or with future updates.</p>
    <p>With Windows Layouts: check how your keyboard behaves on the complete range of Windows layouts.</p>
    <p><img src='<?= cdn('/img/keyboard-debugger.png') ?>' alt='Debug Keyboards Easily Within Keyman Developer '/></p>
  </div>

  <div class="section" id="cross-platform">
    <h2 class="red underline">Cross-Platform</h2>

    <h3 class="red" id="desktop">For desktops</h3>
    <p>Keyman Developer <?php echo $stable_version_int; ?> supports every version of Windows since Windows 7.
        Run Keyman Developer in your Windows OS and build Keyman keyboards that work for your users on their systems.
        These keyboards can also be run on macOS.</p>
    <br><br>

    <h3 class="red" id="mobile">For mobile devices</h3>
    <p>Keyman Developer <?php echo $stable_version_int; ?> lets you create touch layout keyboards and distribute them
      to your iPhones, iPads (iOS 9+), Android phones, and Android tablets.</p>
    <br/><br/>

    <h3 class="red" id="kmw">For the Web</h3>
    <p>Keyman Developer <?php echo $stable_version_int; ?> includes the cutting edge KeymanWeb module.
      Start afresh or transform existing layouts into lightweight JavaScript keyboards to surf the net and
      integrate into your website.</p>

    <dl>
      <dt>Universal Compatibility</dt>
      <dd>With Developer, you can create JavaScript keyboards that can be used in any standards compliant browser,
        including Firefox, Edge, Chrome and Safari. Because the keyboards run in a browser, they'll work just
        as well on Mac and Linux as they do in Windows.<a href='/developer/keymanweb'>Learn more…</a></dd>
      <dd><img class='borderless' src='<?=cdn('/img/compat-browser.png')?>' alt='Develop KeymanWeb Keyboards that
        Run on Any Major Browser, in Windows, Mac and Linux ' /></dd>

      <dt>Diverse Applications</dt>
      <dd>Bookmarklets: build KeymanWeb keyboards for bookmarklets that travel with users anywhere they surf the web.
        <a href='/bookmarklet/'>Learn more…</a></dd>

      <dt>Site Integration</dt>
      <dd>Design KeymanWeb keyboards for integration into any website and let your visitors type in their language.
        <a href='/developer/keymanweb/'>Learn more…</a></dd>
      <dd><img src='<?=cdn('/img/compat-kmw.png')?>' alt='Build KeymanWeb Keyboards for the Web or Your Site ' /></dd>
    </dl>
  </div>

  <div class="section" id="seamless-deployment">
    <h2 class="red underline">Seamless Deployment</h2>
    <p>Send your keyboards wherever you need with the convenience of Keyman keyboard packages.</p>
    <br/><br/>

    <h3 class="red" id="pack">A Complete Package</h3>
    <p>The Package Editor of Keyman Developer <?php echo $stable_version_int; ?> lets you bundle into a single installer
        all the keyboard elements anyone would need to get typing. Also include all the necessary fonts that help get
        users typing in your language on their computer.</p>
    <br/><br/>

    <h3 class="red">Multiple Layouts</h3>
    <p>Put related keyboard layouts into the same package.</p>
    <p><img src='<?= cdn('/img/package-kmx.png') ?>' alt='Put Multiple Layouts Together '/></p>
    <br/><br/>

    <h3 class="red">The Right Fonts</h3>
    <p>Include the best fonts for your language. TTF, TTC, and OTF fonts install automatically on your desktop.</p>
    <p><img class='borderless' src='<?= cdn('/img/package-fonts.png') ?>' alt='Include the Right Fonts '/></p>
    <br/><br/>

    <h3 class="red">On Screen Keyboard</h3>
    <p>Give users a clickable virtual keyboard for easy reference.</p>
    <p><img src='<?= cdn('/img/package-osk.png') ?>' alt='Give Users an On Screen Keyboard '/></p>
    <br/><br/>

    <h3 class="red">Keyboard Help Documentation</h3>
    <p>Add a short readme, starter help and full documentation.</p>
    <p><img src='<?= cdn('/img/package-help.png') ?>' alt='Add Documentation '/></p>
    <br/><br/>

    <h3 class="red">Create keyboards to share</h3>
    <p>We now have a single source for open source keyboards on github.com.</p>
    <p><a href="https://github.com/keymanapp/keyboards">https://github.com/keymanapp/keyboards</a></p>
    <p>After you create your keyboard with Developer, you can submit the keyboard so that the Keyman community can work
        with you to support and maintain your keyboard layout into the future.</p>
    <a href='#host'><img width="25%" src='<?= cdn("/img/keyman-logo.png") ?>' alt="Keyman Logo "/></a>
  </div>

  <div class="section" id="open-source">
    <h2 class="red underline">Completely Open Source and Free</h2>
    <p>Keyman Developer is free to download and free to use with no license to activate.
        Along with the rest of the Keyman products, Keyman Developer is open source and available for others to modify.</p>
  </div>

  <div class="section" id="comprehensive-help">
    <h2 class="red underline">Comprehensive Help</h2>
    <p>Keyman Developer <?php echo $stable_version_int; ?> has comprehensive help to assist you in designing the highest quality keyboards:</p>
    <br/><br/>

    <h3 class="red">Keyman Developer <?php echo $stable_version_int; ?> Help</h3>
    <p>Access help for every feature of Keyman Developer <?php echo $stable_version_int; ?>
      online at <a href='https://help.keyman.com/developer'>https://help.keyman.com/developer</a>. On the site, you'll
      find helpful guides and tutorials to teach you how to develop and distribute your keyboards.</p>
    <br/><br/>

    <h3 class="red">Language Software Community</h3>
    <p>Need additional help? Visit our
      <a href='https://community.software.sil.org/c/keyman'>Keyman Community Site</a>. We love answering questions about Keyman keyboards and
      Keyman Developer <?php echo $stable_version_int; ?>.</p>
    <br/><br/>
  </div>
</div>