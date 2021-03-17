<?php
  require_once('includes/template.php');

  // Required
  head([
    'title' =>'Features | Keyman for Windows ' . $stable_version,
    'css' => ['template.css','feature-template.css'],
    'showMenu' => true
  ]);
  require_once('includes/desktop-features.php');
?>
<div class="info-right">
    <div class="section" id="features">
        <h2 class="red underline">Keyman <?= $stable_version ?> for Windows Features</h2>
        <p>
            From Amharic to Zulu, Keyman <?= $stable_version ?> for Windows is rich in features which make typing in any language easy.
        </p>
        <img src="<?php echo cdn("img/world-lang.png"); ?>"/>
        <br/><br/>
        <p>
            A lightning-quick install, integrated tutorial and instant-access help will have you typing in seconds. It's the perfect mix of powerful software, intelligent keyboards and intuitive design.
        </p>
        <br/>
        <h2 class="red center">Type Everywhere</h2>
        <p>
            Keyman <?= $stable_version; ?> for Windows takes typing in your language everywhere. Use it across your desktop and online, in all your favourite programs for text and image editing, Web browsing, email, IM and so much more.
        </p>
        <p>
            Keyman <?= $stable_version; ?> for Windows runs just as smoothly in 64-bit Windows 10 as 32-bit Windows 7 and everything in between.
        </p>
        <br/><br/><br/>
        <h2 class="red center">What's New</h2>
        <ul>
            <li>Updated for latest release of Windows 10</li>
            <li>Keyman keyboards are no longer hidden from the Windows language picker when you exit Keyman. (This helps maintain input method language tag stability.)</li>
            <li>On Screen Keyboard loads much faster</li>
            <li>Added user interface for configuring all Keyman system-level options (#3733)</li>
            <li>Refreshed user interface no longer depends on Internet Explorer (#1720)</li>
            <li>Smoother and more reliable installation of keyboard languages (#3509)</li>
            <li>Choose associated language when keyboard is installed (#3524)</li>
            <li>Much improved keyboard download experience (#3326)</li>
            <li>Improved BCP 47 tag support (#3529)</li>
            <li>Much improved initial download and installation experience including bundled keyboards (#3304)</li>
            <li>Keyman Configuration changes now apply instantly (#3753)</li>
            <li>Improved user experience when many keyboards installed (#3626, #3627)</li>
            <li>Improved bootstrap installer</li>
            <li>Now uses Chromium to host all web-based UI (e.g. Keyman Configuration)</li>
            <li>Breaking: Keyman Engine no longer supports the keyboard usage page (usage.htm)</li>
        </ul>
    </div>
    <div class="section" id="setup">
        <h2 class="red underline">Easy Setup</h2>
        <p>
            Keyman <?= $stable_version; ?> for Windows installs in just three steps:
        </p>
        <img src="<?php echo cdn("img/screenshots/14/windows/setup-click1.png"); ?>"/>
        <img src="<?php echo cdn("img/screenshots/14/windows/setup-click2.png"); ?>"/>
        <img src="<?php echo cdn("img/screenshots/14/windows/setup-click3.png"); ?>"/>
        <br/>
        <p>
            Installing Keyboards is even easier. Simply download and open the file, and Keyman will do the rest.
        </p>
    </div>
    <div class="section" id="compatibility">
        <h2 class="red underline">Compatibility</h2>
        <p>
            Keyman <?= $stable_version; ?> for Windows runs just as smoothly in 64-bit Windows 10 as 32-bit Windows 7 and everything in between.
        </p>
    </div>
    <div class="section" id="keyboard-list">
        <h2 class="red underline">Access Keyboards For Thousands Of Languages</h2>
        <p>
            Keyman for Windows offers you the biggest keyboard range of any desktop input solution. Here's just a small sample:
        </p>
        <br/>
        <ol class='col' id='col1'>
            <li><h3 class='first'>A</h3>
                    <ol>
                            <li>Abyssinian</li>
                            <li>Afghan</li>
                            <li>Afrikaans</li>
                            <li>Algonquin</li>
                            <li>Albanian</li>
                            <li>Aluet</li>
                            <li>Amazigh</li>
                            <li>Amharic</li>
                            <li>Arabic</li>
                            <li>Armenian</li>
                            <li>Assamese</li>
                            <li>Assyrian</li>
                            <li>Awa</li>
                    </ol>
            </li>
            <li><h3>B</h3>
                    <ol>
                            <li>Basque</li>
                            <li>Balochi</li>
                            <li>Bashkir</li>
                            <li>Belorussian</li>
                            <li>Bislama</li>
                            <li>Blackfoot</li>
                            <li>Breton</li>
                            <li>Bosnian</li>
                            <li>Buang</li>
                            <li>Bulgarian</li>
                            <li>Burmese</li>
                            <li>Busa</li>
                    </ol>
            </li>
            <li><h3>C</h3>
                    <ol>
                            <li>Catalan</li>
                            <li>Cherokee</li>
                            <li>Chinese</li>
                            <li>Coptic</li>
                            <li>Corsican</li>
                            <li>Cornish</li>
                            <li>Cree</li>
                            <li>Croatian</li>
                            <li>Czech</li>
                    </ol>
            </li>
            <li><h3>D</h3>
                    <ol>
                            <li>Dakota</li>
                            <li>Danish</li>
                            <li>Dene</li>
                            <li>Dinka</li>
                            <li>Dogrib</li>
                            <li>Dutch</li>
                    </ol>
            </li>
            <li><h3>E</h3>
                    <ol>
                            <li>Egyptian</li>
                            <li>English</li>
                            <li>Esperanto</li>
                            <li>Estonian</li>
                            <li>Éwé</li>
                    </ol>
            </li>
        </ol>

        <ol class='col' id='col2'>
            <li><h3 class='first'>F</h3>
                    <ol>
                            <li>Faroese</li>
                            <li>Farsi</li>
                            <li>Filipino</li>
                            <li>Finnish</li>
                            <li>French</li>
                            <li>Frisian</li>
                            <li>Fufulde</li>
                            <li>Fulani</li>
                    </ol>
            </li>
            <li><h3>G</h3>
                    <ol>
                            <li>Gaelic</li>
                            <li>Galician</li>
                            <li>Ge'ez</li>
                            <li>Georgian</li>
                            <li>German</li>
                            <li>Greek, Modern</li>
                            <li>Greek, Ancient</li>
                            <li>Greenlandic</li>
                    </ol>
            </li>
            <li><h3>H</h3>
                    <ol>
                            <li>Hausa</li>
                            <li>Hawaiian</li>
                            <li>Haitian</li>
                            <li>Hebrew</li>
                            <li>Hindi</li>
                            <li>Hopi</li>
                            <li>Hungarian</li>
                    </ol>
            </li>
            <li><h3>I</h3>
                    <ol>
                            <li>Icelandic</li>
                            <li>Igbo</li>
                            <li>Inuit</li>
                            <li>Inuktitut</li>
                            <li>Irish</li>
                            <li>Italian</li>
                    </ol>
            </li>
            <li><h3>J</h3>
                    <ol>
                            <li>Jola-Fonyi</li>
                            <li>Jutish</li>
                    </ol>
            </li>
            <li><h3>K</h3>
                    <ol>
                            <li>Kaba</li>
                            <li>Kannada</li>
                            <li>Karelian</li>
                            <li>Kashmiri</li>
                            <li>Kashubian</li>
                            <li>Khmer</li>
                            <li>Korean</li>
                            <li>Kwakiutl</li>
                            <li>Kyrgyz</li>
                    </ol>
            </li>
        </ol>

        <ol class='col' id='col3'>
            <li><h3 class='first'>L</h3>
                    <ol>
                            <li>Ladin</li>
                            <li>Lakota</li>
                            <li>Latin</li>
                            <li>Latvian</li>
                            <li>Lao</li>
                            <li>Lithuanian</li>
                    </ol>
            </li>
            <li><h3>M</h3>
                    <ol>
                            <li>Macedonian</li>
                            <li>Malayalam</li>
                            <li>Maltese</li>
                            <li>Mandage</li>
                            <li>Manx</li>
                            <li>Marathi</li>
                            <li>Mohawk</li>
                            <li>Mongolian</li>
                    </ol>
            </li>
            <li><h3>N</h3>
                    <ol>
                            <li>Naskapi</li>
                            <li>Nepali</li>
                            <li>Norwegian</li>
                            <li>Nzema</li>
                    </ol>
            </li>
            <li><h3>O</h3>
                    <ol>
                            <li>Occitan</li>
                            <li>Ojibwa</li>
                            <li>Okanagan</li>
                    </ol>
            </li>
            <li><h3>P</h3>
                    <ol>
                            <li>Pashto</li>
                            <li>Polish</li>
                            <li>Portuguese</li>
                            <li>Pular</li>
                    </ol>
            </li>
            <li><h3>Q</h3>
                    <ol>
                            <li>Quechua</li>
                    </ol>
            </li>
            <li><h3 id='col_R'>R</h3>
                    <ol>
                            <li>Rawang</li>
                            <li>Romani</li>
                            <li>Romanian</li>
                            <li>Romansch</li>
                            <li>Russian</li>
                    </ol>
            </li>
        </ol>

        <ol class='col' id='col4'>
            <li><h3 class='first'>S</h3>
                    <ol>
                            <li>Saami</li>
                            <li>Samogho</li>
                            <li>Scots</li>
                            <li>Seneca</li>
                            <li>Serbian</li>
                            <li>Serer-Sine</li>
                            <li>Sindhi</li>
                            <li>Sinhala</li>
                            <li>Slovak</li>
                            <li>Slovenian</li>
                            <li>Songhay</li>
                            <li>Sorbian</li>
                            <li>Spanish</li>
                            <li>Swahili</li>
                            <li>Swedish</li>
                            <li>Swiss German</li>
                            <li>Syriac, Ancient</li>
                    </ol>
            </li>
            <li><h3>T</h3>
                    <ol>
                            <li>Tagalog</li>
                            <li>Tamil</li>
                            <li>Thai</li>
                            <li>Tibetan</li>
                            <li>Tigrigna</li>
                            <li>Tok Pisin</li>
                            <li>Turkish</li>
                    </ol>
            </li>
            <li><h3>U</h3>
                    <ol>
                            <li>Urdu</li>
                            <li>Uyghur</li>
                    </ol>
            </li>
            <li><h3>V</h3>
                    <ol>
                            <li>Vai</li>
                            <li>Vietnamese</li>
                    </ol>
            </li>
            <li><h3 id='col_W'>W</h3>
                    <ol>
                            <li>Welsh</li>
                            <li>Wolof</li>
                    </ol>
            </li>
            <li><h3 id='col_X'>X</h3>
                    <ol>
                            <li>Xhosa</li>
                    </ol>
            </li>
            <li><h3 id='col_Y'>Y</h3>
                    <ol>
                            <li>Yiddish</li>
                            <li>Yupik</li>
                    </ol>
            </li>
            <li><h3 id='col_Z'>Z</h3>
                    <ol>
                            <li>Zapotec</li>
                            <li>Zhuang</li>
                            <li>Zulu</li>
                    </ol>
            </li>
        </ol>
    </div>
    <div class="section" id="keyman-dev">
        <h2 class="red underline">Build Custom Keyboard Layouts To Your Specifications</h2>
        <p>
            If our exhaustive list of keyboards isn't enough, build your own with Keyman Developer <?php echo $stable_version; ?>, our most powerful keyboard creation tool yet.
        </p>
        <p>
            Learn more about <a href="/developer/">Keyman Developer here</a>.
        </p>
        <img src="<?php echo cdn("img/developer9.png"); ?>"/>
    </div>
    <div class="section" id="unicode">
        <h2 class="red underline">Unicode 13.0 Compliant</h2>
        <p>
            Keyman <?= $stable_version; ?> for Windows complies with Unicode 13.0 – the international standard
            for language encoding. Everything you type with our Unicode keyboards will be readable to anyone.
        </p>
        <p>
            With Unicode keyboards for Keyman <?= $stable_version; ?> for Windows, say goodbye to square boxes and garbled text. What you type won't degrade.
        </p>
        <img src="<?php echo cdn("img/no-squares.png"); ?>"/>
        <br/>
        <p>
            Even without Keyman, your readers won't need Keyman to read what you type. All they'll need is a font with support for your language.
        </p>
    </div>
    <div class="section" id="keyboard-limit">
        <h2 class="red underline">Keyboard Limit</h2>
        <p>
            With Keyman for Windows, you can install and enable as many keyboards as you need.
        </p>
        <img src="<?php echo cdn("img/screenshots/14/windows/tab-keyboards.png"); ?>"/>
    </div>
    <div class="section" id="language-association">
        <h2 class="red underline">Associate Keyboards With Windows Languages</h2>
        <p>
            Associate your Keyman keyboards with a Windows language to ensure easy typing.
        </p>
        <p>
            Keyman <?= $stable_version ?> for Windows allows you to associate a keyboard with multiple Windows languages.
        </p>
        <img src="<?php echo cdn("img/screenshots/14/windows/tab-layout.png"); ?>"/>
    </div>
    <div class="section" id="keyboard-information">
        <h2 class="red underline">Keyboard Information</h2>
        <p>
            Access advanced keyboard information such as Keyboard filename, version number, encodings, layout type and more.
        </p>
        <img src="<?php echo cdn("img/screenshots/14/windows/tab-layout.png"); ?>"/>
    </div>
    <div class="section" id="hotkeys">
        <h2 class="red underline">Hotkeys For Everything</h2>
        <p>
            Set hotkeys for Keyman keyboards, Keyman features and even Windows languages from the Hotkeys tab of Keyman Configuration.
        </p>
        <img src="<?php echo cdn("img/screenshots/14/windows/tab-hotkeys.png"); ?>"/>
    </div>
    <div class="section" id="language-switcher">
        <h2 class="red underline">Language Switcher</h2>
        <p>
            Language Switcher gathers all your Windows languages and Keyman keyboards in one menu. Jump to any keyboard with a single hotkey.
        </p>
        <img src="<?php echo cdn("img/screenshots/14/windows/languageswitcher.png"); ?>"/>
        <br/><br/>
        <p>
            The Keyman Menu keeps your installed Keyman keyboards in order and easy to access from the Windows taskbar.
        </p>
        <img src="<?php echo cdn("img/screenshots/14/windows/menu.png"); ?>"/>
    </div>
    <div class="section" id="character-map">
        <h2 class="red underline">Keyman Character Map</h2>
        <p>
            Access every character in the newest version of the Unicode Standard from the Keyman Character Map.
        </p>
        <p>
            Insert over 109,000 letters and symbols with a double-click. Say goodbye to multi-step clipboard actions.
        </p>
        <p>
            Search with instant feedback, by name, range, block, font, or code point, using standard wildcards.
        </p>
        <img src="<?php echo cdn("img/screenshots/14/windows/charmap-big.png"); ?>"/>
    </div>
    <div class="section" id="font-helper">
        <h2 class="red underline">Font Helper</h2>
        <p>
            Font Helper takes the stress out of finding the right font for your keyboard. Your fonts are ranked to show which ones give the best support.
        </p>
        <p>
            Not only does Font Helper rank your fonts, it also shows which characters in your keyboard each font supports.
        </p>
        <img src="<?php echo cdn("img/screenshots/14/windows/fonthelper.png"); ?>"/>
    </div>
    <div class="section" id="osk">
        <h2 class="red underline">On Screen Keyboard</h2>
        <p>
            The On Screen Keyboard visually teaches typing for a Keyman keyboard.
        </p>
        <p>
            For mnemonic layouts, the On Screen Keyboard auto-adapts to the language and layout of your hardware keyboard.
        </p>
        <p>
            Type using your hardware keyboard or click on screen.
        </p>
        <img src="<?php echo cdn("img/screenshots/14/windows/osk-greek-566x226.png"); ?>"/>
        <br/><br/><br/>
        <h2 class="red underline">Keyboard Usage</h2>
        <p>
            Many keyboards include in-depth keyboard help, available in Keyboard Usage.
        </p>
        <p>
            For some of our most complex keyboards, dynamic charts in Keyboard Usage help make learning to type easy.
        </p>
        <img src="<?php echo cdn("img/usage-dynamic.png"); ?>"/>
    </div>
    <div class="section" id="support">
        <h2 class="red underline">Technical Support</h2>
        <p>
            All users have full access to the built-in and online help documents, deep Keyman diagnostic tools, as well as the Keyman Community Forums.
        </p>
        <img src="<?php echo cdn("img/screenshots/14/windows/tab-support.png"); ?>"/>
    </div>
    <div class="section" id="customers">
        <h2 class="red underline">Used By The Biggest</h2>
        <p>
            Keyman <?= $stable_version; ?> for Windows is the result of nearly 30 years of dedication to perfecting Keyman.
            Everything we've learned since 1991 we've poured into Keyman <?= $stable_version; ?> for Windows.
            We're as dedicated as ever to making Keyman for Windows the best multi-lingual typing solution for you.
        </p>
        <p>
            Keyman is used by more than 1,000,000 people in over 1,000 languages. All those user experiences feed back into perfecting Keyman.
        </p>
        <p>
            We've worked with a community of developers around the world to create the keyboards we offer, in order to meet the needs of local languages like yours.
        </p>
        <p>
            Keyman is maintained by a team of software developers who understand the complexities of computer and human languages.
        </p>
        <p>
            Organisations worldwide rely on Keyman for Windows for multi-lingual typing. Join the crowd.
        </p>
        <img src="<?php echo cdn("img/customers.png"); ?>"/>
    </div>
</div>

