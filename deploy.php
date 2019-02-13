<?php
namespace Deployer;

require 'recipe/common.php';

set('application', 'silverstripe');
set('repository', '<repository>');
set('keep_releases', 3);

// Shared files/dirs between deploys
set('shared_files', []);
set('shared_dirs', [
    'public/assets',
]);

// Writable dirs by web server
set('writable_dirs', [
    'silverstripe-cache',
    'public/assets',
]);

// production
host('<hostname>')
    ->stage('production')
    ->user('<user>')
    ->set('deploy_path', '<deploy_path>')
    ->addSshOption('UserKnownHostsFile', '/dev/null')
    ->addSshOption('StrictHostKeyChecking', 'no');

// Tasks
desc('Deploy');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:silverstripe',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success',
]);

task('deploy:silverstripe-before', function () {
    run('cd {{release_path}} && cp .env.{{stage}} .env');
    run('cd {{release_path}}/public && cp .htaccess-{{stage}} .htaccess');
    run('cd {{release_path}} && vendor/bin/sake dev/build');
});

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
