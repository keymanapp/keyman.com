---
title: CLDR/LDML Keyboards
description: SIL Keyman supports the CLDR/LDML Keyboard specification
---

## CLDR Keyboard Support in Keyman

SIL Keyman supports the [CLDR/LDML Keyboard specification][1].

### Introducing the CLDR/LDML Keyboard specification

LDML is the Locale Data Markup Language. It it an XML-based format specified as
the Unicode Consortium’s specification UTS#35, maintained by the Common Locale
Data Repository (CLDR) Technical Commitee. Part 7 of UTS#35 pertains to keyboard
layouts. This specification has been updated as part of [CLDR Release 46][1],
authored by the [CLDR Keyboard Subcommittee][2].

Like the [Keyman Keyboard Language][3] (`.kmn`) format, the LDML Keyboard format
defines how keystrokes are interpreted and how keys are laid out in a virtual
keyboard.  The LDML format has been defined from the beginning to become a
cross-platform industry standard, with active participation from several Unicode
member organizations including SIL Global.

```xml
<!-- Example: French AZERTY Keyboard in LDML format -->
<layer modifier="shift">
  <row keys="1 2 3 4 5 6 7 8 9 0 degree plus" />
  <row keys="A Z E R T Y U I O P umlaut pound" />
  <row keys="Q S D F G H J K L M percent micro" />
  <row keys="close-angle W X C V B N question period slash section" />
  <row keys="space" />
</layer>
```

### Keyman and LDML

As was announced in the [March 2022][4] and [February 2023][5] roadmaps, the
Keyman team has been working in anticipation of LDML support in Keyman and
Keyman Developer.  Version 17.0 of Keyman includes support for LDML keyboards on
desktop platforms - Windows, macOS, and Linux - and Keyman Developer 17.0
includes support for compiling and validation LDML keyboards.

As of February 2025:

* Support for LDML keyboards on the web and iOS and Android platforms is in
  development.

* A cross-platform visual design tool for LDML keyboards is in development.

The LDML support is being developed in our cross-platform Keyman Core component,
which will enable a consistent feature set across all platforms including web by
version 19.0, with a common code base.

_Below is a screen capture showing the use of an LDML keyboard via a development version of Keyman for Linux._

![Movie: typing characters using an LDML keyboard](/cdn/dev/img/ldml-keyman-linux.gif)

## Frequently Asked Questions for Keyman LDML Support


- **How will the LDML format be supported with Keyman?**

  From a technical perspective, the LDML format is a supported input to the
  Keyman Developer Compiler (kmc). The XML file is compiled into a
  [KMX compiled keyboard file][6], and can be used just as `.kmn` files which
  are compiled to `.kmx`.

- **How will the LDML format be supported with Keyman Developer?**

  Keyman Developer 17.0 supports compiling LDML keyboards and basic XML editing.
  A full LDML editor is under development for Keyman Developer 19.0. (February
  2025 update: This target slipped from 18.0 to 19.0.)

- **What is the impact on existing developed keyboards in .kmn format?**

  None. Keyman and Keyman Developer continue to support the thousands of
  languages in .kmn files and the .kmn format.

- **Will there be a facility available to automatically convert .kmn to LDML or vice versa?**

  The LDML specification is designed primarily to support new keyboard layouts.
  At a later stage, we would like to make available software to assist
  developers in migrating keyboards to the new format, including tooling to
  compare and verify the capabilities of a .kmn versus a similar LDML keyboard
  definition.

- **I have other questions. Who should I ask?**

  Please direct any other questions regarding LDML to the
  [SIL Keyman Community][7].

[1]: https://www.unicode.org/reports/tr35/tr35-74/tr35-keyboards.html#Contents
[2]: https://cldr.unicode.org/index/keyboard-workgroup
[3]: https://help.keyman.com/developer/language/
[4]: https://blog.keyman.com/2022/03/keyman-roadmap-march-2022/
[5]: https://blog.keyman.com/2023/02/keyman-roadmap-february-2023/
[6]: https://help.keyman.com/developer/current-version/reference/file-types/kmx
[7]: https://community.software.sil.org/c/keyman
