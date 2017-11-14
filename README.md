Procedimentos para deploy

copie a pasta para o local do webserver

cd para acompanha

crie a database e usuario para a database 
e modifique app/config/parameters.yml

se clonou do git faça:
composer install --no-dev --optimize-autoloader

se baixou o zip com o projeto completo
como root ou permisão rode

SYMFONY_ENV=prod

Clear your Symfony Cache
php app/console cache:clear --env=prod --no-debug

Dump your Assetic Assets
php app/console assetic:dump --env=prod --no-debug

utilize o link https://symfony.com/doc/current/setup/web_server_configuration.html
para configurar o webserver, lembrando que o documentroot será o web/

problemas de permissões
https://symfony.com/doc/current/setup/file_permissions.html