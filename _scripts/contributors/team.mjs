/*
 * Keyman is copyright (C) SIL Global. MIT License.
 *
 * Created by mcdurdin on 2026-01-28
 */
export function genTeamMarkdownSegment(teamData) {
  let md = `<div class="contributors" id="team">`;

  for(const member of teamData) {
    const img = member.img ? `/cdn/dev/img/${member.img}` : `https://github.com/${member.handle}.png?size=240`;
    md += `
<div markdown="1">

[![](${img})](bios/${member.handle})

[${member.name}](bios/${member.handle})

${member.title}

</div>
`;
  }

  md += `</div>`;

  return md;
}