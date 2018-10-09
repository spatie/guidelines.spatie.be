# New Project Setup

## Git Repository

Create a repository on the Wilber Group GitHub using the [repo naming rules](https://guidelines.wilbergroup.com/workflow/version-control#repo-naming-conventions).

Example: `WilberGroup/guidelines.wilbergroup.com`

<!-- Add More Steps -->

Lastly, update the `.env.example` file with values relevant to the project (database name, app url, our Slack webhook url, etc.)

## Server

1. Provision a new server on Forge. Use a kebab-cased version of the domain name for the droplet (example: `guidelines-wilbergroup-com`)
1. Create a new site with root `/current/public`
1. Ensure the name of the database makes sense
1. Run our ansible scripts on the freshly provisioned server
1. Start one or two queue workers: `default`, and if using Blender `media_queue`
1. Update the relevant `.env` variables. Don't forget to add the necessary service API keys later.
1. Enable backups in BackupPC for the project
1. Update our shared `.ssh/config` file, so we can SSH to servers without specifying a username

## Services

Our Blender sites use a few third party services. Here's a checklist of what needs to be set up.

Unless specified otherwise, use the website's domain name as its identifier (API key name, property name, etc.)

1. Create a new **Sendgrid** API key
1. Create a new **Google Analytics** property
1. Create a new **Google Tag Manager** container
    - Create a constant containing the Universal Analytics ID
    - Set up a tag for Google Analytics pageviews
1. Set up **Bugsnag** for Laravel
1. Set up **Bugsnag** for JavaScript
