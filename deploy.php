<?php
namespace Deployer;

require 'recipe/common.php';

set('allow_anonymous_stats', false);
set('repository', 'kain.twm.eu/group-name/project-name.git');
set('bin/php', '/usr/bin/php7.4');

set('shared_files', ['.env']);
set('shared_dirs', [
    'public/assets',
]);

set('writable_dirs', [
    'public/assets',
]);

// acceptance
host('default.wbmn.nl/acceptance')
    ->stage('acceptance')
    ->user('user')
    ->set('deploy_path', '~/site')
    ->addSshOption('UserKnownHostsFile', '/dev/null')
    ->addSshOption('StrictHostKeyChecking', 'no');

// production
host('default.wbmn.nl/production')
    ->stage('production')
    ->user('flexcraft_prod')
    ->set('deploy_path', '~/site')
    ->addSshOption('UserKnownHostsFile', '/dev/null')
    ->addSshOption('StrictHostKeyChecking', 'no');

// Tasks
task('release', [
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:upload',
    'deploy:requirements',
    'deploy:shared',
    'deploy:writable',
    'deploy:silverstripe',
    'deploy:symlink',
    'deploy:php:reload',
    'deploy:unlock',
]);

task('deploy:upload', function () {
    upload(__DIR__ . '/', '{{release_path}}');
});

task('deploy:requirements', function () {
    run('cd {{release_path}} && curl -sS https://getcomposer.org/installer | {{bin/php}}');
    run('cd {{release_path}} && {{bin/php}} composer.phar check-platform-reqs --no-dev');
});

task('deploy:silverstripe', function () {
    run('cd {{release_path}} && {{bin/php}} vendor/silverstripe/framework/cli-script.php dev/build');
});

task('deploy:php:reload', function () {
//    Please include the reload you need
//    run('sudo systemctl reload php7.4-fpm');
//    run('sudo systemctl reload apache2');
});

task('deploy', [
    'release',
    'cleanup',
    'success',
])->desc('Deploy your project');

after('deploy:failed', 'deploy:unlock');
