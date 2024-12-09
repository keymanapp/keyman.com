### Setup for Localization

[init-container.sh](../../resources/init-container.sh) contains steps for the Docker container to compile .po files to .mo files which PHP uses for `gettext()`.

If you want to compile the files on your host machine, install `gettext`.

```bash
sudo apt-get install gettext
```

### Adding locales

The Docker image has the "en_US.UTF-8" locale enabled in `/etc/locale.gen`
We'll use `textdomain` to specify filenames for "switching" localization. 
The filenames will include the `%locale%` as defined in the [crowdin.com project](https://crowdin.com/project/keymancom).

Note: the details below will get refactored to use a Locale.php class

In the example below, the English file `keyboards-en.po` is copied to `keyboards-fr-FR.po` for French.

1. In `/_includes/locale/en/LC_MESSAGES/`
    * Copy `keyboards-en.po` file and rename to the `keyboards-fr-FR.po`.
    * Translate/upload the new .po file to crowdin
    * Convert .po file to .mo with the following

```bash
msgfmt keyboards-fr-FR.po --output-file=keyboards-fr-FR.mo
```

(The container handles the msgfmt step in init-container.sh)

2. Add the file to the PHP (path is relative the PHP file)

```php
bindtextdomain("keyboards-fr-FR", "../_includes/locale");
```

3. To use French,
```php
textdomain('keyboards-fr-FR');
```

----

For formatted string, use the PHP wrapper [`_s(msgstr, $args)`](./Locale.php).
