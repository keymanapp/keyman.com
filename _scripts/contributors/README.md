# Contributors

Generate the /about/team/index.md file from contributors on Github and
translators on crowdin.

## Usage
```sh
node . --crowdin-key <crowdin-key> --github-key <github-key>
```
Run `node . --help` for more


# /about/team/team.json

team.json includes both core team members and other contributors who may not
show up in commit history. File should be fairly self-explanatory; here are a
few quick notes:

* `pr`: try and link to a PR number when adding a contributor for future
  reference, although the `pr` field is not used by code.
* `url`: If a user does not have an obvious GitHub profile, include a link to
  another online reference such as community; in this case the `handle` field
  is not used except for display purposes.
