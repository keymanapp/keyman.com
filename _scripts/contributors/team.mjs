/*
 * Keyman is copyright (C) SIL Global. MIT License.
 *
 * Created by mcdurdin on 2026-01-28
 */
import * as fs from "node:fs";

export function genTeamMarkdownSegment(teamData) {
  let md = `<div class="contributors" id="team">`;

  for(const member of teamData) {
    const img = member.img ? `/cdn/dev/img/${member.img}` : `https://github.com/${member.handle}.png?size=240`;
    const url = fs.existsSync(`../../about/team/bios/${member.handle}.md`) ? `bios/${member.handle}` : `https://github.com/${member.handle}`;
    md += `
<div markdown="1">

[![](${img})](${url})

[${member.name}](${url})

${member.title}

</div>
`;
  }

  md += `</div>`;

  return md;
}