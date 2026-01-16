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
  // Header for the markdown file. Can include explaination, title, etc.
  let headers = "---\ntitle: Contributors\n---";

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
  fs.writeFileSync(program.opts().output, `${headers}\n${githubSeg != null ? githubSeg : ""}\n${crowdinSeg != null ? crowdinSeg : ""}`);
}

function genMarkdownSegment(name, major, minor) {
  // Initiate the markdown variable as a level 2 header of the section's name.
  let markDown = `## ${name}\n`;

  // Add the Major contributors, one at a time
  markDown += `### Major ${name}\n`;
  major.forEach((user) => {
    markDown += `[<img src="${user.avatar_url}" alt="${user.login}'s profile picture" width="50"/> ${user.login}](${user.html_url} "${user.login}")\n\n`;
  });

  // Add the "Minor" contributors, one at a time
  markDown += `### Other ${name}\n`;
  minor.forEach((user) => {
    markDown += `[<img src="${user.avatar_url}" alt="${user.login}'s profile picture" width="50"/>](${user.html_url} "${user.login}") `;
  });
  return markDown;
}
