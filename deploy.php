<?php
namespace Deployer;
require 'recipe/symfony.php';

// Configuration - Colocar nome do projeto e repositorio
set('nomeProjeto','');
set('repository', '');
add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', ['app/sessions']);

// Servers
server('homolog', 'pitangueira.uft.edu.br', 22)
    ->user('sysadmin')
    ->password('53w53!!4')
    ->set('deploy_path','/var/www/{{nomeProjeto}}')
    ->stage('homologacao');
server('producao', 'bacaba.uft.edu.br', 22)
    ->user('sysadmin')
    ->password('53w53!!4')
    ->set('deploy_path','/var/www/{{nomeProjeto}}')
    ->stage('bacaba');

// Tasks
desc('Restart PHP-FPM service');
task('php-fpm:restart', function () {
    // The user must have rights for restart service
    // /etc/sudoers: username ALL=NOPASSWD:/bin/systemctl restart php-fpm.service
    run('sudo systemctl restart php5-fpm.service');
});
after('deploy:symlink', 'php-fpm:restart');

/**
 * Executa o assetics avanzu
 */
task('uft:avanzu_install', function () {
    run("SYMFONY_ENV=prod php {{release_path}}/" . trim(get('bin_dir'), '/') ."/console avanzu:admin:fetch-vendor");
    run("mv {{release_path}}/web/bundles/avanzuadmintheme/vendor/adminlte/plugins/daterangepicker/daterangepicker.css {{release_path}}/web/bundles/avanzuadmintheme/vendor/adminlte/plugins/daterangepicker/daterangepicker-bs3.css");
})->desc('Update avanzu');
after('deploy:vendors','uft:avanzu_install');

/**
 * Configura o nginx
 */
task('uft:configura_nginx', function () {
    $mensagem = run("sudo nginxConf.sh {{nomeProjeto}}");
    run("sudo service nginx restart");
    $mensagem = str_replace('{url}',get('server.host'),$mensagem);
    writeln(" <comment>$mensagem</comment> ");
})->desc('Configurando NGINX');
after('cleanup','uft:configura_nginx');

/**
 * Executa o update do banco de dados
 */
task('uft:database_update', function () {
    $serverName = get('server.name');
    $run = false;
    $run = askConfirmation("Run doctrine:schema:update on $serverName server?", $run);
    if ($run) {
        run("SYMFONY_ENV=prod php {{release_path}}/" . trim(get('bin_dir'), '/') ."/console doctrine:schema:update --force");
    }
})->desc('Update database');
after('deploy:cache:warmup','uft:database_update');