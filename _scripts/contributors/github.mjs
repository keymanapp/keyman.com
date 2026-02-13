/*
 * Keyman is copyright (C) SIL Global. MIT License.
 *
 * Created by pbdurdin on 2026-01-18
 *
 * Generate github section of contributors.md
 */
import { Octokit } from "octokit";
import { paginateRest } from "@octokit/plugin-paginate-rest";

// Initiatlize an empty Octokit variable, to be set later.
const OctokitInit = Octokit.plugin(paginateRest);
let octokit = null;
const githubOrgName = "keymanapp";

export async function getGithub(githubKey) {
  // Set the aforementioned Octokit variable, with the provided key.
  octokit = new OctokitInit({
    auth: githubKey,
  });

  // Get a list of every repo in the keymanapp github organization
  let allRepos = await getReposByOrg(githubOrgName);

  // Get the data of each of those repositories
  let allRepoData = await getAllRepos(allRepos);
  return allRepoData;
}

export function genGithub(repos) {
  const MAJOR_CONTRIBUTION_THRESHOLD = 100;

  // Initialize empty arrays, to be added to later
  let major = [];
  let minor = [];
  let all = [];

  // For each item in the provided data,
  Object.keys(repos).forEach(repo => {
    repos[repo].forEach((user) => {
      // ... check for bots, and skip over if one is found,
      if (/^(keyman-server|keyman-status|.+\[bot\])$/.test(user.login)) {
        return;
      }

      // ... if we have not already added this user to the user list, add them,
      if (!all.map(user => user.login).includes(user.login)) {
        all.push(user);
        return;
      }

      // ... Otherwise, increase their contributions score.
      let i = all.findIndex(oldUser => oldUser.login == user.login);
      all[i].contributions += user.contributions;
    });
  });

  // Sort into the major and minor categories
  all.forEach((user) => {
    if (user.contributions > MAJOR_CONTRIBUTION_THRESHOLD) {
      major.push(user);
    }
    else {
      minor.push(user);
    };
  });

  return [major, minor];
}

async function getReposByOrg(org) {
  // Fetch a list of all repositories belonging to this organization.

  console.log("Retrieving list of Repositories");
  let repos = await octokit.paginate(`GET /orgs/${org}/repos`, {
    org,
    per_page: 100,
    type: "sources",
    headers: {
      "X-GitHub-Api-Version": "2022-11-28",
    },
  });

  // Map the repository data to make mearly a list of names.
  return repos.map(repo => repo.name);
}

async function getAllRepos(allRepos) {
  // Fetch the data for the given list of repositories.

  let allRepoData = {};

  // Using for instead of foreach, as foreach does not support asynchrony.
  for (let repo of allRepos) {
    // Get data, then concat it to all previously fetched data.
    console.log(`Fetching repository contributors: ${repo}`);
    let repoData = await getRepo(repo);
    allRepoData[repo] = repoData;
  };
  return allRepoData;
}

async function getRepo(repoName) {
  // Fetch data for repo of the inputted name.
  let repo = await octokit.paginate(`GET /repos/${githubOrgName}/${repoName}/contributors`, {
    owner: "keymanapp",
    repo: repoName,
    per_page: 100,
    headers: {
      "X-GitHub-Api-Version": "2022-11-28",
    },
  });
  return repo;
}
