<?php
    /* (c) Anton Medvedev <anton@elfet.ru>
     *
     * For the full copyright and license information, please view the LICENSE
     * file that was distributed with this source code.
     */

    require_once 'recipe/symfony.php';


    /**
     * Faz copia do parameters.yml para a pasta compartilhada
     */
    task('uft:copy_parameters', function () {
        $basePath = config()->getPath();
        $sharedPath = "$basePath/shared";
        $releasePath = env()->getReleasePath();
        $parametersPath = "$releasePath/app/config/parameters.yml";

        // Create shared dir if does not exist
        run("mkdir -p $sharedPath/app/config/");

        run("if [ -f  $parametersPath ]; then cp $parametersPath $sharedPath/app/config/parameters.yml ; fi");
    })->desc('Copiando parameters');

    /**
     * Cria symlink da pasta web para raiz da aplicaçao
     */
    task('uft:link_web', function () {
        $basePath = config()->getPath();

        run("ln -s current/web test-deployer");
    })->desc('Crinado Symlink para pasta web');



    task('uft:writable_dirs', function () {
        $user = config()->getUser();
        $wwwUser = config()->getWwwUser();
        $permissionMethod = get('permission_method', 'acl');
        $releasePath = env()->getReleasePath();
        cd($releasePath);
// User specified writable dirs
        $dirs = (array) get('writable_dirs', []);
        switch ($permissionMethod) {
            case 'acl':
                $run = run("if which setfacl; then echo \"ok\"; fi");
                if (empty($run)) {
                    writeln('<comment>Enable ACL support and install "setfacl"</comment>');
                    return;
                }
                $commands = [
                    'sudo setfacl -R -m u:' . $user . ':rwX -m u:' . $wwwUser . ':rwX %s',
                    'setfacl -dR -m u:' . $user . ':rwx -m u:' . $wwwUser . ':rwx %s'
                ];
                break;
            case 'chmod':
                $commands = [
                    'chmod +a "' . $user . ' allow delete,write,append,file_inherit,directory_inherit" %s',
                    'chmod +a "' . $wwwUser . ' allow delete,write,append,file_inherit,directory_inherit" %s'
                ];
                break;
            case 'chmod_bad':
                $commands = ['chmod -R a+w %s'];
                break;
        }
        $releasePath = env()->getReleasePath();
        foreach ($dirs as $dir) {
// Create shared dir if does not exist
            run("mkdir -p $releasePath/$dir");
            foreach ($commands as $command) {
                run(sprintf($command, $dir));
            }
        }
    })->desc('Make writable dirs');


    /**
     * Instala os asstes
     */
    task('uft:assets_install', function () {
        $releasePath = env()->getReleasePath();
        cd($releasePath);
        run("php app/console assets:install --env=prod");
    })->desc('Instalar assets');

    /**
     * Executa o update do banco de dados
     */
    task('uft:database_update', function () {
        $releasePath = env()->getReleasePath();
        $prod = get('env', 'prod');
        $serverName = config()->getName();

        $run = false;

        if (output()->isVerbose()) {
            $run = askConfirmation("Run doctrine:schema:update on $serverName server?", $run);
        }

        if ($run) {
            run("SYMFONY_ENV=prod  php $releasePath/app/console doctrine:schema:update --force");
        }
    })->desc('Update database');

    /**
     * Carrega as DataFixtures
     */
    task('uft:load_fixtures', function () {
        $releasePath = env()->getReleasePath();

        run("SYMFONY_ENV=prod  php $releasePath/app/console doctrine:fixtures:load ");
    })->desc('Loading fixtures');


    /**
     * Clear cache
     */
    task('uft:cache:clear', function () {
        $releasePath = env()->getReleasePath();
        $cacheDir = env()->get('cache_dir', "$releasePath/app/cache");

        $prod = get('env', 'prod');

        run("php $releasePath/app/console cache:clear  --env=$prod --no-debug");

        run("chmod -R g+w $cacheDir");
    })->desc('Warming up cache');


    /**
     * Executa p deploy para servidor
     */
    task('run', array('deploy:start',
        'deploy:prepare',
        'deploy:update_code',
        'uft:copy_parameters',
        'deploy:shared',
        'uft:writable_dirs',
        'deploy:assets',
        'deploy:vendors',
        'deploy:cache:warmup',
        'uft:assets_install',
        'deploy:assetic:dump',
        'uft:database_update',
        'deploy:symlink',
        'cleanup',
        'uft:link_web',
        'deploy:end'
    ))->desc('Deploy para servidor');

