# New Project Setup

## Git

If you're creating a [Blender](https://github.com/spatie/blender) or [Spoon](https://github.com/spatie/spoon) application, first clone it's main repository and remove the `.git` folder. This will be the base application for your new project.

Create a repository on the Spatie organization on GitHub using the [repo naming rules](https://guidelines.spatie.be/workflow/version-control#repo-naming-conventions).

Example: `spatie/guidelines.spatie.be`

## Server

1. Provision a new server on Forge. Use a kebab-cased version of the domain name for the droplet (example: `guidelines-spatie-be`)
1. Create a new site with root `/current/public`
1. Ensure that there's a database with a same name
1. Run our ansible scripts on the freshly provisioned server
1. Start one or two queue workers: `default`, and if using Blender `media_queue`
1. Update the relevant `.env` variables. Don't forget to add the necessary service API keys later.
1. Enable backups in BackupPC for the project
1. Update our shared `.ssh/config` file, so we can SSH to servers without specifying a username

## Services

Our Blender sites use a few third party services. Here's a checklist on what needs to be set up.

Unless specified otherwise, use the website's domain name as it's identifier (API key name, property name, etc.)

1. Create a new **Sendgrid** API key
1. Create a new **Google Analytics** property
1. Create a new **Google Tag Manager** container
    - Create a constant containing the Universal Analytics ID
    - Set up a tag for Google Analytics pageviews
1. Set up **Bugsnag** for Laravel
1. Set up **Bugsnag** for JavaScript
