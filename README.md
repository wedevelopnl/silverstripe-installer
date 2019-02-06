# The Webmen silverstripe installer
Extension on the default silverstripe installer

## Usage
Run
```
docker run composer create-project thewebmen/silverstripe-installer . --ignore-platform-reqs
```

Then use the following setup for docker:

1. `docker-compose up --build`
2. Open http://localhost:8080


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

## Testing
To test the codestyle of your project run the command: `make test`.

## Requirements

- Composer
- NPM
- Docker
