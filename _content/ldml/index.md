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

Learn more about the LDML Keyboard initiative at the [CLDR Keyboard Working Group home page](https://cldr.unicode.org/index/keyboard-workgroup). An excerpt:

> ### The challenge and promise of Keyboards
> Text input is a core component of most computing experiences and is most
> commonly achieved using a keyboard, whether hardware or virtual (on-screen or
> touch). However, keyboard support for most of the world’s languages is either
> completely missing or often does not adequately support the input needs of
> language communities. Improving text input support for minority languages is
> an essential part of the Unicode mission.
>
> Keyboard data is currently completely platform-specific. Consequently, language
> communities and other keyboard authors must see their designs developed
> independently for every platform/operating system, resulting in unnecessary
> duplication of technical and organizational effort.
>
> There is no central repository or contact point for this data, meaning that such
> authors must separately and independently contact all platform/operating system
> developers.
>
> ### LDML: The universal interchange format for keyboards
>
> The CLDR Keyboard Working Group has written a definition for keyboards (UTS#35 part 7) in order to define core keyboard-based
> text input requirements for the world’s languages. This format allows the
> physical and virtual (on-screen or touch) keyboard layouts for a language to be
> defined in a single file. Input Method Editors (IME) or other input methods are
> not currently in scope for this format.
>
> ### CLDR: A home for the world’s newest keyboards
>
> Today, there are many existing
> platform-specific implementations and keyboard definitions. This project does
> not intend to remove or replace existing well-established support.
>
> The goal of this project is that, where otherwise unsupported languages are
> concerned, CLDR becomes the common source for keyboard data, for use by
> platform/operating system developers and vendors.
>
> As a result, CLDR will also become the point of contact for keyboard authors and
> language communities to submit new or updated keyboard layouts to serve those
> user communities. CLDR has already become the definitive and publicly available
> source for the world’s locale data.

---

### Keyman project progress

As of December 2025:

* Support for LDML keyboards on the web and iOS and Android platforms is in
  development.

* A cross-platform visual design tool for LDML keyboards is in development.

* Tooling to convert Keyman keyboards to LDML keyboards is in development.

---

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
