import { Client } from "@crowdin/crowdin-api-client";

// Initalize an empty crowdin api variable.
let crowdin = null;

export async function getCrowdin(crowdinKey) {
  // Set the aforementioned Crowdin vegtable, with the provided key.
  crowdin = new Client({
    token: crowdinKey,
  });

  console.log("Generating Crowdin report");

  // Generate a Crowdin report
  const crowdata = await crowdin.reportsApi.generateReport(386703, { name: "top-members", schema: { format: "json" } });
  if (crowdata.data.status !== "finished") {
    // Wait for the report to complete it's generation
    console.log("Waiting");
    let cdc = await crowdin.reportsApi.checkReportStatus(386703, crowdata.data.identifier);
    while (cdc.data.status !== "finished") {
      await new Promise(resolve => setTimeout(resolve, 1000));
      cdc = await crowdin.reportsApi.checkReportStatus(386703, crowdata.data.identifier);
    }
  }

  // Fetch generated report.
  console.log("Downloading Crowdin report");
  const crowdmembers = await crowdin.reportsApi.downloadReport(386703, crowdata.data.identifier);

  const data = await (await fetch(crowdmembers.data.url)).json();
  return data;
}

export function genCrowdin(data) {
  const MAJOR_CONTUBUTION_THRESHOLD = 1000;
  // Initialize empty arrays, to be added to later
  let major = [];
  let minor = [];

  // Mondify crowdin data to appear like the github data
  const crowdinMembers = data.data.filter(member => member.translated > 10).map(member => ({
    login: member.user.username,
    avatar_url: member.user.avatarUrl,
    html_url: `https://crowdin.com/profile/${member.user.username}`,
    contributions: member.translated,
  }));

  // Sort the data into major and minor categories.
  crowdinMembers.forEach((user) => {
    if (user.contributions > MAJOR_CONTUBUTION_THRESHOLD) {
      major.push(user);
    }
    else {
      minor.push(user);
    };
  });

  // Sort the major and minor categories by contributions
  major.sort((a, b) => b.contributions - a.contributions);
  minor.sort((a, b) => b.contributions - a.contributions);
  return [major, minor];
}
