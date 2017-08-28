# New Project Setup

## Git

If you're copying an existing application, first clone it's main repository and remove the `.git` folder. This will be the base application for your new project.

Create a repository on our organization on GitHub using the [repo naming rules](https://guidelines.adaptivemedia.se/workflow/version-control#repo-naming-conventions).

Example: `adaptivemedia/guidelines.adaptivemedia.se

## Server

### 1. Create a new server at the provider (eg. Glesys or DO):
- Type: OpenVZ		
- Template: Ubuntu >= 16.04, 64-bit
- Datacenter: Depends (but generally Stockholm)
- Bandwidth: >= 100 Mbit

Make sure the *hostname* is easily identifiable (system, service, purpose, env etc), eg:

*Only prod*
- workfox

*Only dev & prod*
- workfox-dev
- workfox-prod

*Web & db separated with dev & prod*
- workfox-web-dev
- workfox-db-dev
- workfox-web-prod
- workfox-db-prod

*With multiple instances*
- workfox-web-dev1

### 2. Create the server in forge
1. Create a custom VPS. Make sure that the *hostname* matches. Notice that on Glesys the installscript will fail in the end with Swapon/swapfile. This is ok, all is done.
1. Create a new site with root `/current/public`
1. Ensure that there's a database with a sane name
1. Update the relevant `.env` variables. Don't forget to add the necessary service API keys later.

### 3. Add your SSH-key to Forge:

 - Open a local terminal
 - `$ cat ~/.ssh/id_rsa.pub | pbcopy`
 - Paste your key under "SSH Keys"

 ## 4. Update the server (date, php/nginx conf etc)

 - Run Recipe in Forge called "Conf PHP/nginx"
 - Make sure the timezone is correct: `sudo dpkg-reconfigure tzdata` 
 - Make sure the date is correct: `date`

## Services

Our apps use a few third party services. Here's a checklist on what usually needs to be set up.

Unless specified otherwise, use the website's domain name as it's identifier (API key name, property name, etc.)

1. Create a new **Sendgrid** API key
1. Create a new **Google Analytics** property
1. Set up **Bugsnag** for Laravel
