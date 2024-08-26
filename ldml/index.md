---
title: LDML
description: SIL Keyman is adding support for the LDML Keyboard specification.
---

## LDML Support in Keyman

SIL Keyman is adding support for the LDML Keyboard specification.

### Introducing the LDML Keyboard specification

LDML is the Locale Data Markup Language. It it an XML-based format specified as the Unicode Consortium’s specification UTS#35, maintained by the Common Locale Data Repository (CLDR) Technical Commitee. Part 7 of UTS#35 pertains to keyboard layouts. This specification has been released as part of [CLDR Release 45](https://www.unicode.org/reports/tr35/tr35-72/tr35-keyboards.html#Contents), authored by the [CLDR Keyboard Subcommittee](https://cldr.unicode.org/index/keyboard-workgroup).

Like the [Keyman Keyboard Language](https://help.keyman.com/developer/language/) (`.kmn`) format, the LDML Keyboard format defines how keystrokes are interpreted and how keys are laid out in a virtual keyboard.  The LDML format has been defined from the beginning to become a cross-platform industry standard, with active participation from several Unicode member organizations including SIL International.  The intention is to provide a draft specification as a technical preview for public review in mid-2023, with a first release later in 2023.

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

As was announced in the [March 2022](https://blog.keyman.com/2022/03/keyman-roadmap-march-2022/) [February 2023](https://blog.keyman.com/2023/02/keyman-roadmap-february-2023/) roadmaps, the Keyman team has been working in anticipation of LDML support in Keyman and Keyman Developer.  We plan to provide initial support for the LDML technical preview version in desktop devices in the Keyman 17.0 release and some supporting tools, with full Keyman Developer support and touch platforms coming in version 18.0.

The LDML support is being developed in our cross-platform Keyman Core component, which will enable a consistent feature set across all platforms including web by version 19.0, with a common code base.

_Below is a screen capture showing the use of an LDML keyboard via a development version of Keyman for Linux._

![Movie: typing characters using an LDML keyboard](/cdn/dev/img/ldml-keyman-linux.gif)

## Frequently Asked Questions for Keyman LDML Support


- **How will the LDML format be supported with Keyman?**

  From a technical perspective, the LDML format will be a newly supported input to the Keyman Developer Compiler (kmc). The XML file will be compiled into a <a href="https://help.keyman.com/developer/current-version/reference/file-types/kmx">KMX compiled keyboard file</a>, and can be used just as `.kmn` files which are compiled to `.kmx`.

- **How will the LDML format be supported with Keyman Developer?**

  Keyman Developer 17.0 supports compiling LDML keyboards and basic XML editing. A full LDML editor is under development for Keyman Developer 18.0.

- **What is the impact on existing developed keyboards in .kmn format?**

  None. Keyman and Keyman Developer continue to support the thousands of languages in .kmn files and the .kmn format.

- **Will there be a facility available to automatically convert .kmn to LDML or vice versa?**

  The LDML specification is designed primarily to support new keyboard layouts. At a later stage, we would like to make available software to assist developers in migrating keyboards to the new format, including tooling to compare and verify the capabilities of a .kmn versus a similar LDML keyboard definition.

- **I have other questions. Who should I ask?**

  Please direct any other questions regarding LDML to the [SIL Keyman Community](https://community.software.sil.org/c/keyman).

