# Version Control

All our projects use Git, mostly with a repository hosted on GitHub. Since we're a small team, and most projects have less than 3 people working on it simultaneously, we have pretty loose Git guidelines since we rarely bump into conflicts.

## Repo naming conventions

If the repo contains the source code of the a site it's name should be the main naked domain name of that site. It should be lowercased.

- Bad: `https://www.adaptivemedia.se`, `www.adaptivemedia.se`
- Good: `adaptivemedia.se`

Sites that are hosted on a subdomain may use that subdomain in their name

- Bad: `adaptivemedia.se-guidelines`
- Good: `guidelines.adaptivemedia.se`

If the repo concerns something else, for example a package, it's name should be kebab-cased.

- Bad: `LaravelBackup`, `Spoon`
- Good: `laravel-backup`, `spoon`

## Branches

If you're going to remember one thing in this guide, remember this: **Once a project's gone live, the master branch must always be stable**. It should be safe to deploy the master branch to production at all times. All branches are assumed to be active, stale branches should get cleaned up accordingly. The develop branch will generally hold commits for the next release.

### Projects in initial development

Projects that aren't live yet have at least two branches: `master` and `develop`. Avoid committing directly on the master branch, always commit through develop.

Feature branches are optional, if you'd like to create a feature branch, make sure it's branched from `develop`, not `master`.

### Live projects

Once a project goes live, all future commits to `master` and `develop` must be added through a feature/hotfix/changes branch. In most cases, it's preferred to squash your commits on merge.

There's no strict ruling on feature branch names, just make sure it's clear enough to know what they're for. Branches may only contain lowercase letters and hyphens.

- Bad: `feature-mailchimp`, `random-things`, `fixes`
- Good: `feature/mailchimp`, `hotfix/delivery-costs` or `changes/updates-june-2016`

### Pull requests

Merging branches via GitHub pull requests isn't a requirement, but encouraged and can be useful if:

- You want a peer to review your changes
- You want to ensure your branch can be merged and commits can be squashed via an interface
- Future you wants a quick way to retrieve that point in history by browsing passed pull requests

### Merging and rebasing

Ideally, rebase your branch regularly to reduce the chance of merge conflicts.

- If you want to deploy a feature branch directly to master, use `git merge <branch> --squash`
- If your push is denied, rebase your branch first using `git rebase`

## Commits

There's not a strict ruling on commits in projects in initial development, however, descriptive commit messages are recommended. After a project's gone live, descriptive commit messages are required. Always use present tense in commit messages.

- Non-descriptive: `wip`, `commit`, `fixes`
- Descriptive: `Update deps`, `Fix vat calculation in delivery costs`

Ideally, prefer granular commits.

- Acceptable: `Cart fixes`
- Better: `Fix add to cart button`, `Fix cart count on home`

## Git Tips

### Creating granular commits with `patch`

If you've made multiple changes but want to split them into more granular commits, use `git add -p`. This will open an interactive session in which you can choose which chunks you want to stage for your commit.

### TODO - more tips

## Resources

- Most of this is based on the [GitHub Flow](https://guides.github.com/introduction/flow/)
- Merge vs. rebase on [Atlassian](https://www.atlassian.com/git/tutorials/merging-vs-rebasing/workflow-walkthrough)
- Merge vs. rebase by [@porteneuve](https://medium.com/@porteneuve/getting-solid-at-git-rebase-vs-merge-4fa1a48c53aa)
