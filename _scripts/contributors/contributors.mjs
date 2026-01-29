/*
 * Keyman is copyright (C) SIL Global. MIT License.
 *
 * Created by pbdurdin on 2026-01-18
 *
 * Generate about/team/index.md
 */
import { Command } from "commander";
import * as fs from "node:fs";
import { getGithub, genGithub } from "./github.mjs";
import { getCrowdin, genCrowdin } from "./crowdin.mjs";
import { genTeamMarkdownSegment } from "./team.mjs";

// Parse CLI input
const program = new Command();
program.name("node .")
  .description("Script to generate https://keyman.com/about/contributors")
  .version("0.1.0")
  .option("-o, --output <filename>", "output file", "contributors.md")
  .option("-g, --github-key <key>", "github api authentication key (https://github.com/settings/tokens)")
  .option("-G, --github-cache", "use cached github data from previous run")
  .option("-c, --crowdin-key <key>", "crowdin api authentication key (https://crowdin.com/setting#api-key)")
  .option("-C, --crowdin-cache", "use cached crowdin data from previous run")
  .action(main);
program.parse(process.argv);

async function main() {

  const teamData = JSON.parse(fs.readFileSync('../../about/team/team.json', 'utf-8'));
  let teamSeg = genTeamMarkdownSegment(teamData);

  let githubMajorSeg = "", githubMinorSeg = "";
  // If the user provided a key for github
  if (program.opts().githubKey) {
    // Fetch a list users that have made contributions to "keymanapp" on github, transform it, then generate markdown.
    let githubData = program.opts().githubCache && fs.existsSync('./github.cache.json')
      ? JSON.parse(fs.readFileSync('./github.cache.json', 'utf-8'))
      : await getGithub(program.opts().githubKey);
    fs.writeFileSync('./github.cache.json', JSON.stringify(githubData, null, 2));

    // We exclude the following repos which are basically dependencies with
    // largely external contributors, to provide a more accurate picture of
    // people contributing to Keyman itself
    const excludedRepos = ['keyman-ios-beta.herokuapp.com', 'keyman-ios-alpha.herokuapp.com', 'onboard-keyman'];
    excludedRepos.forEach(repo => delete githubData[repo]);

    const teamHandles = teamData.map(member => member.handle);
    Object.keys(githubData).forEach(repo => {
      githubData[repo] = githubData[repo].filter(user => !teamHandles.includes(user.login));
    });
    let [gMajor, gMinor] = genGithub(githubData);
    githubMajorSeg = genMajorMarkdownSegment("github-major", gMajor);
    githubMinorSeg = genMinorMarkdownSegment("github-minor", gMinor);
  }

  let crowdinSeg = "";
  if (program.opts().crowdinKey) {
    // Fetch a list users that have made contributions to "keyman" on crowdin, transform it, then generate markdown.
    let crowdinData = program.opts().githubCache && fs.existsSync('./crowdin.cache.json')
      ? JSON.parse(fs.readFileSync('./crowdin.cache.json', 'utf-8'))
      : await getCrowdin(program.opts().crowdinKey);
    fs.writeFileSync('./crowdin.cache.json', JSON.stringify(crowdinData, null, 2));


    let [, cMinor] = genCrowdin(crowdinData);
    crowdinSeg = genMinorMarkdownSegment("crowdin-minor", cMinor);
  }

  let markdown = fillTemplate(teamSeg, githubMajorSeg, githubMinorSeg, crowdinSeg);

  // To the users input file for output (default: contributors.md), write a join of the header, the github segment.
  fs.writeFileSync(program.opts().output, markdown);
}

function fillTemplate(teamSeg, githubMajorSeg, githubMinorSeg, crowdinMinorSeg) {
  // Header for the markdown file. Can include explanation, title, etc.
  return `
---
title: About the Keyman team
---
<div><style>@import './team.css';</style></div>

On this page we list contributors who have made changes to the Keyman project,
through GitHub and our localization platform Crowdin. We are aware of many other
people who have made valuable contributions to the project and we would like to
acknowledge their generosity, though we cannot easily list each person here.

➡️ [**Get involved**](../get-involved)

---

## Core Keyman team

The core Keyman team is a small group of dedicated software developers, working
across 4 continents. We keep the project running, fixing bugs, adding features
and generally trying to make Keyman a great product to use.

${teamSeg}

---

## Major contributors

We gratefully acknowledge those who have had made a significant contribution,
with 100 or more commits accepted into Keyman repositories.

${githubMajorSeg}

---

## Other contributors

${githubMinorSeg}

---

## Translators

${crowdinMinorSeg}

---

We update this page weekly with new contributors.
`;

}

function genMajorMarkdownSegment(id, major) {
  // Initiate the markdown variable as a level 2 header of the section's name.
  let markDown = `\n<div class="contributors" id="${id}">\n`;

  major.forEach((user) => {
    markDown += `\n<div markdown="1">\n\n[![](${user.avatar_url})](${user.html_url})\n\n[${user.login}](${user.html_url})\n\n</div>\n`;
  });

  markDown += `\n</div>\n`;

  return markDown;
}

function genMinorMarkdownSegment(id, minor) {
  let markDown = `\n<div class="contributors" id="${id}" markdown="1">\n`;

  minor.forEach((user) => {
    markDown += `[<img class='contributor-minor' src="${user.avatar_url}" alt="${user.login}" />](${user.html_url} "${user.login}")\n`;
  });

  return markDown + `\n</div>\n`;
}
