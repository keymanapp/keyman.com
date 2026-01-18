/*
 * Keyman is copyright (C) SIL Global. MIT License.
 *
 * Created by pbdurdin on 2026-01-18
 *
 * Generate crowdin section of contributors.md
 */
import { Client } from "@crowdin/crowdin-api-client";

// Initalize an empty crowdin api variable.
let crowdin = null;
const crowdinId = 386703;

export async function getCrowdin(crowdinKey) {
  // Set the aforementioned Crowdin vegtable, with the provided key.
  crowdin = new Client({
    token: crowdinKey,
  });

  console.log("Generating Crowdin report");

  // Generate a Crowdin report
  const crowdata = await crowdin.reportsApi.generateReport(crowdinId, { name: "top-members", schema: { format: "json" } });
  if (crowdata.data.status !== "finished") {
    // Wait for the report to complete it's generation
    console.log("Waiting");
    let cdc = await crowdin.reportsApi.checkReportStatus(crowdinId, crowdata.data.identifier);
    while (cdc.data.status !== "finished") {
      await new Promise(resolve => setTimeout(resolve, 1000));
      cdc = await crowdin.reportsApi.checkReportStatus(crowdinId, crowdata.data.identifier);
    }
  }

  // Fetch generated report.
  console.log("Downloading Crowdin report");
  const crowdmembers = await crowdin.reportsApi.downloadReport(crowdinId, crowdata.data.identifier);

  const data = await (await fetch(crowdmembers.data.url)).json();
  return data;
}

export function genCrowdin(data) {
  // Modify crowdin data to appear like the github data
  const crowdinMembers = data.data.filter(member => member.translated > 10).map(member => ({
    login: member.user.username,
    avatar_url: member.user.avatarUrl,
    html_url: `https://crowdin.com/profile/${member.user.username}`,
    contributions: member.translated,
  }));

  // Sort the users by name
  crowdinMembers.sort((a, b) => a.login.localeCompare(b.login));
  return [[], crowdinMembers];
}
