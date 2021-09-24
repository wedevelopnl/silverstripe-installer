# Webmen Default Silverstripe 4 Installer
This project installs the latest stable SilverStripe 4 CMS release.

Included in this installer;

* SilverStripe 4
* Docker environment with MariaDB/PHP-FPM/Nginx/Mailhog
* PHP CSFixer
* PHPStan
* PHPUnit
* Some default silverstripe packages (like thewebmen/silverstripe-elemental-grid, thewebmen/silverstripe-menustructure. Check `composer.json` for an overview with all packages)
* Webpack
* Bulma

## Important notice
* This repository should NOT contain a `composer.lock` file.
  * But the `composer.lock` file SHOULD get included in the new project
  * This is the reason the `composer.lock` is not included in the `.gitignore`
* You should also check the `composer.json` file on a new project and update them where needed

## How to use

### Installation

* `git clone https://github.com/thewebmen/silverstripe-installer project-name/`
* `cd project-name`
* Change the host ports in `docker-compose.yml`, `.env` and in this readme to an unused number (1 to 65535)
* Create a `.npmrc` with FontAwesome PRO keys (key found in BitWarden)
* Run `docker-compose up`
* Change the project name and description in `package.json`
* Change the project name and description in `composer.json`
* Change the name of this readme file and remove the "How to use and Important notice" chapter
* Change the stable releases in `composer.json` to the installed minor releases

### Overriding .env and using xDebug
If you want to override the `.env` or use xDebug, you can use the `docker-compose.override.yaml.dist` in combination with a `.env.local`.

* `cp docker-compose.override.yaml.dist docker-compose.override.yaml`
* create a `.env.local` with the data you don't want to get exposed
* Change target to `php-fmp` instead of `php-fpm-dev` if you want to disable xDebug

### Menus

On the default installation, there are some pre-defined menus with the following slugs;
* main-nav
* footer-top-nav
* footer-bottom-nav

This navigation's needs to get added in the `Menu` section, found in the Admin.

## Docker
`docker-compose up`\
http://localhost:50080/

**Default admin login:**\
http://localhost:50080/admin \
Username; admin\
Password; admin

## Database
**Mariadb on port 50336**

Server: mariadb\
Name: silverstripe\  
User: root\
Password: password\

## Deployment
* Change the `repository` in `deploy.php` to the correct gitlab repository
* Change the `host` and `user` for acceptance and production in `deploy.php`
* `mv gitlab-ci.yml.example gitlab-ci.yml`
* Edit the `gitlab-ci.yml` with the configuration you need

## PHP cs
`make test`  
`make fix-cs`  
Could be useful to enable in phpstorm (settings -> search for 'php cli interpreter')

## JS / CSS
**Please make sure the version in your `.nvmrc` is in sync with the `NODE_VERSION` argument in the `Dockerfile`**

Set node version: `nvm use`  
Build: `npm run build`  
Watch: `npm run watch`  

### Fontawesome

At Webmen we use Fontawesome PRO. You can find the `.npmrc` key in BitWarden.

If you don't have Fontawesome PRO, remove FontAwesome PRO from `package.json`

## ESlint
Could be useful to enable in phpstorm (settings -> search for 'eslint' -> automatic eslint configuration)

## Dev build
It is easier to do a dev build via the cli to avoid user rights issues  
`make devbuild`  

And there is also a `Make` command to run a dev/build with flush argument
`make devbuildflush`

## CMS icons
https://silverstripe.github.io/silverstripe-pattern-lib/?selectedKind=Admin%2FIcons&selectedStory=Icon%20reference&full=0&addons=1&stories=1&panelRight=0&addonPanel=storybook%2Factions%2Factions-panel

## License
See [License](LICENSE)

## Development and contribution
This repository is mostly used for internal use by Webmen, but we decided to publish the source code.
If you want to contribute, please first create an issue, so we can discuss the change. 
