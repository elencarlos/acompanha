<?php

require 'uft.php';
set('use_ssh2', false);
// Define server for deploy.
// Let's name it "main" and use 22 port.
server('main', 'inga.uft.edu.br', 22)
    ->path('/var/deploy/base') // Define base path to deploy you project.
    ->user('redes', '53w53!!4d');  // Define SSH user name and password.
                                 // You can skip password and it will be asked on deploy.
                                 // Also you can connect to server SSH via public keys and ssh config file.

// Specify repository from which to download your projects code.
// Server has to be able clone your project from this repository.
set('repository', 'git@gitlab.uft.edu.br:meloflavio/fichacatalografica.git');

//task('export:prod', function () {
//    runLocally('php app/console cache:clear --env=prod --no-debug');
//})->description('cache:clear --env=prod --no-debug');
//
//after('deploy:start', 'export:prod');