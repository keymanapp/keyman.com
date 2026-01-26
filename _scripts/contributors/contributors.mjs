/*
 * Keyman is copyright (C) SIL Global. MIT License.
 *
 * Created by pbdurdin on 2026-01-18
 *
 * Generate contributors.md
 */
import { Command } from "commander";
import * as fs from "node:fs";
import { getGithub, genGithub } from "./github.mjs";
import { getCrowdin, genCrowdin } from "./crowdin.mjs";

// Parse CLI input
const program = new Command();
program.name("node .")
  .description("Script to generate https://keyman.com/about/contributors")
  .version("0.1.0")
  .option("-o, --output <filename>", "output file", "contributors.md")
  .option("-g, --github-key <key>", "github api authentication key (https://github.com/settings/tokens)")
  .option("-c, --crowdin-key <key>", "crowdin api authentication key (https://crowdin.com/setting#api-key)")
  .action(main);
program.parse(process.argv);

async function main() {
  // Header for the markdown file. Can include explanation, title, etc.
  const headers = `
---
title: Keyman Contributors
---
<div><style>@import './contributors.css';</style></div>

This page lists contributors who have made changes to the Keyman project, through GitHub and
our localization platform Crowdin. We are aware of many other people who have made valuable
contributions to the project and we would like to acknowledge their generosity, though
we cannot easily list each person here.

For now, major contributors are simply those who have made over 100 commits accepted into
Keyman repositories.

We update this page weekly with new contributors.

* [Get involved](../get-involved)

---
`;

  const footers = `

---

## Navigation

* [About the Keyman team](../developers)
* [Previous core team members](previous)
* All contributors (this page)
* [Join the team](../get-involved)
`;

  let githubSeg = null;
  // If the user provided a key for github
  if (program.opts().githubKey) {
    // Fetch a list users that have made contributions to "keymanapp" on github, transform it, then generate markdown.
    let githubData = await getGithub(program.opts().githubKey);
    let [gMajor, gMinor] = genGithub(githubData);
    githubSeg = genMarkdownSegment("Contributors", gMajor, gMinor);
  }

  let crowdinSeg = null;
  if (program.opts().crowdinKey) {
    // Fetch a list users that have made contributions to "keyman" on crowdin, transform it, then generate markdown.
    let crowdinData = await getCrowdin(program.opts().crowdinKey);
    let [cMajor, cMinor] = genCrowdin(crowdinData);
    crowdinSeg = genMarkdownSegment("Translators", cMajor, cMinor);
  }

  // To the users input file for output (default: contributors.md), write a join of the header, the github segment.
  fs.writeFileSync(program.opts().output, `${headers}\n${githubSeg != null ? githubSeg : ""}\n${crowdinSeg != null ? crowdinSeg : ""}\n${footers}`);
}

function genMarkdownSegment(name, major, minor) {
  // Initiate the markdown variable as a level 2 header of the section's name.
  let markDown = `## ${name}\n`;

  if (major.length > 0) {
    // Add the Major contributors, one at a time
    if (minor.length > 0) {
      markDown += `### Major ${name}\n`;
    }
    major.forEach((user) => {
      markDown += `[<img class='contributor-major' src="${user.avatar_url}" alt="${user.login}" width="50"/>](${user.html_url} "${user.login}") `;
      markDown += `[${user.login}](${user.html_url})\n\n`;
    });
  }

  if (minor.length > 0) {
    // Add the "Minor" contributors, one at a time
    if (major.length > 0) {
      markDown += `### Other ${name}\n`;
    }
    minor.forEach((user) => {
      markDown += `[<img class='contributor-minor' src="${user.avatar_url}" alt="${user.login}" width="50"/>](${user.html_url} "${user.login}") `;
    });
  }
  return markDown;
}
