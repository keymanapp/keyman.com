---
title: Keyman Engine 14.0 API changes
---

# Windows

* Keyman for Windows version numbers will be presented with only three
  components rather than four, matching other platforms. Executable files will
  continue to use Windows standard resource four-component versions.

* **BREAKING:** Keyman Configuration now uses Chromium rather than Internet Explorer for its
  user interface. There may be Internet Explorer-specific code in older
  integrations that will need to be brought into standards compliance.

* Keyman Engine for Windows now supports `IKeymanKeyboardsInstalled2`,
  `IKeymanKeyboardFile2`, `IKeymanPackagesInstalled2` and `IKeymanPackageFile2`,
  all of which add a single new method `Install2`. This new method enables
  installation of a Keyman keyboard without a corresponding install of the input
  method for the default language, allowing for a single user step install of
  keyboard + specific language. This is the recommended way of installing
  keyboard languages for Keyman Engine for Windows 14.

# iOS

* Keyman Engine 14 requires linking with Sentry.framework.

* The old `LanguageResource` `protocol` has been reworked, with
  `AnyLanguageResource` taking its place.
    - `LanguageResource` still exists, but now uses an `associatedtype`, which
      restricts its use in return types and some variable declarations.
    - `AnyLanguageResource` is equivalent for cases that don't rely upon the
      specific resource type, perfectly matching the original version of the
      `protocol`.
* New API:
  `ResourceDownloadManager.downloadPackage(withKey:from:withNotifications:completionBlock)`
    - This function downloads a package from a known location and automatically
      parses it (as with `KeymanPackage.parse`), preparing it for installation
      or returning errors that arise during such attempts.
    - If the `completionBlock` parameter's closure declares its first parameter
      as a specific type of package, `downloadPackage` will perform
      error-handling should the package type not match.
* New API:  `ResourceFileManager.install(resourceWithID:from:)`
    - Given a parsed/prepared package and the ID of a resource within it it,
      this function installs that resource within KeymanEngine.
    - It will also examine the contents of the package for potential updates and
      perform them automatically.
* The `KeymanPackage` class is now much more fully fleshed-out, providing many
  package-oriented properties and methods.
* The keyboard and lexical model download notifications (such as
  `KeyboardDownloadCompleted`) have been removed in favor of package-oriented
  variants (such as `PackageDownloadCompleted`).
    - They generally return a `KeymanPackage.Key` identifying the triggering
      package.
    - As the `Completed` version represents a successful download, it will
      instead provide the downloaded `KeymanPackage` instance.
* User installation of new keyboards should utilize the new
  `KeyboardSearchViewController`.
* `KeymanPackage.parse` no longer needs a completion block
    - The new version has been added that is explicitly synchronous and directly
      returns the old completion block's parameter.
    - The old version is still in-place and functions as before - synchronously.
* Similarly, multiple `ResourceFileManager` methods no longer need completion
  blocks, also directly returning the values they provided.
   - Exception:  `promptPackageInstall`, which is asynchronous due to user
     interaction.
   - Affects two `prepareKMPInstall` versions and `finalizePackageInstall`.
* `Manager`:
   - `addKeyboard` and `addLexicalModel` deprecated in favor of the new
     `ResourceFileManager.install` variants
   - `preloadFiles` also deprecated in favor of KMP-based installation, which
     should also use the method listed above.
* `APIKeyboardRepository` and related classes/protocols are now deprecated.
* `APILexicalModelRepository` and related classes/protocols have been removed.
* `LanguageViewController` and `LanguageDetailViewController`, both views
  previously used by users to install keyboards, have been removed.
* Note that applications using the KeymanEngine framework should consider use of
  the `Migrations.migrate(storage:)` method, as the file organization scheme and
  file lookup patterns used internally by KeymanEngine have changed slightly.

# Android

* **BREAKING**: Moved from API 19 to minimum API level 21 (Lollipop / Android
  5.0) with corresponding Chromium minimum release M37.
* **BREAKING**: Replaced Fabric/Crashlytics with Sentry for crash reporting
  * build.gradle changes:
    ```gradle
    android {
      compileOptions {
        sourceCompatibility = JavaVersion.VERSION_1_8
        targetCompatibility = JavaVersion.VERSION_1_8
      }
    }

    dependencies {
      implementation 'io.sentry:sentry-android:2.0.1'
    }
    ```
* **BREAKING**: Additional dependencies needed for 14.0
  * androidx.preference:preferences:1.1.1. (Needed for Keyman Engine to update
    display language)
* **BREAKING**: Deprecated `KMManager` APIs
  * [KMManager.showLanguageList()](https://help.keyman.com/developer/engine/android/current-version/KMManager/showLanguageList)
    - Keyman Engine no longer uses cloud keyboard catalog, so
      `showLanguageList()` no longer displays. (Embedded browser used to search
      for keyboards) (Updated)
  * `KMManager.KMKey_CustomKeyboard` - "Custom" property for keyboards no longer
    tracked (no change to help.keyman.com)
  * `KMManager.KMKey_CustomModel` - "Custom" property for lexical models no
    longer tracked (no change to help.keyman.com)
  * `addKeyboard` - Deprecate syntax using `HashMap<string, string>`. Replace
    with `<Keyboard>`
* **BREAKING**: Changed KMManager APIs
  * [KMManager.getLatestKeyboardFileVersion()] - Syntax **may** change from
    `(String packageID, String keyboardID)` to `(String languageID, String
    keyboardID)`
* Feature: Add `getDefaultKeyboard()` and `setDefaultKeyboard()`
* Feature: Add action `GLOBE_KEY_ACTION_SHOW_SYSTEM_KEYBOARDS` that brings up
  Android input method picker (Updated)
* Addition: Add `getLanguagePredictionPreferenceKey()` and
  `getLanguageCorrectionPreferenceKey()` but note they're intended only for
  Keyman for Android, not 3rd party apps.
* Use keyboard / lexical model packages instead of standalone .js files
  * Keyboards are now strictly installed from .kmp keyboard packages. 3rd party
    apps should include their "default" keyboard and lexical model packages at
    the project's `assets/` level. `KMManager` will extract them into
    `assets/packages/` and `assets/models/` respectively. (No longer append
    version string to .js keyboard file and manually copy to `assets/cloud/`
    folder)
    * build.gradle changes:
    ```gradle
    android {
      // Don't compress kmp files so they can be copied via AssetManager
      aaptOptions {
        noCompress "kmp"
      }
    }
    ```
  * Keyman Engine no longer includes `sil_euro_latin` as a default installed
    keyboard.

# Web

* **BREAKING**: Ceased support for Internet Explorer.
* **BREAKING**: No longer testing against legacy Edge.
* **DEPRECATED**:  When language-specific wordbreaking is needed, custom lexical
  models (dictionaries) should specify a core `wordbreaker` algorithm that can
  break all words in a string at once, rather than only the last word in a
  context.
  - `wordbreak` will still be useful when running under Keyman 12 and 13.
  - if `wordbreak` is specified but `wordbreaker` is not, it will be
    incompatible with version 14.0's enhanced correction features.
* 14.0 brings significant enhancements to predictive text when models are able
  to provide a way to efficiently "traverse" the lexicon.
  - This is handled automatically for compiled wordlist-based models, even those
    compiled in previous versions of Keyman.
  - Custom models (which are currently not possible to compile within Developer)
    should refer to the new `LexiconTraversal` type specified within the
    `@keymanapp/models-types` package.  Models must implement this type and the
    related `LexicalModel.traverseFromRoot()` to be compatible with these
    enhancements.
