<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'my-app');

// Project repository
set('repository', 'https://github.com/yoshi-oonishi/laravel-dev.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', [.env]);
add('shared_dirs', [strage]);

// Writable dirs by web server 
add('writable_dirs', []);


// Hosts

host('project.com')
    ->set('deploy_path', '/var/www/backoffice/');    
    
// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

