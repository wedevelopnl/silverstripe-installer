# The Webmen silverstripe installer
Extension on the default silverstripe installer

## Usage
Run
```
composer create-project thewebmen/silverstripe-installer .
```

Then use the following setup for docker:

1. `cp docker-compose.override.yml.dist docker-compose.override.yml`
2. Run `composer config cache-dir` to get the cache directory and set it in `docker-compose.override.yml` 
3. `docker-compose up`
4. Open http://localhost:10080

#### Linux

If you're using linux should uncomment the `users` key in `docker-compose.override.yml` with your own UID.
You can figure out your UID by executing the `id` command as yourself.

## Gulp
The following gulp commands are available:
- gulp (build js and sass and watch both)
- gulp js (build js)
- gulp watchjs (watch js)
- gulp sass (build sass)
- gulp watchsass (watch sass)

Javascript is linted using eslint, make sure to enable eslint in your phpstorm

## Deployment
Replace the following variables in deploy.php:
- repository
- hostname
- user
- deploy_path
