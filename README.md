# siec

#Actualizar repositorio local
git pull origin master

#Actualización de esquema de base de datos
bin/console doctrine:schema:update --force

#Actualizar modulos Node.js
npm update

#Actualización de composer
composer update

#Actualización de composer optimizando módulos en producción
composer.phar install --no-dev --optimize-autoloader

#Compilar scripts con webpack en desarrollo
yarn encore dev

#Compilar scripts con webpack en producción
yarn encore production

#Instalar fixtures desarrollo
bin/console hautelook:fixtures:load --purge-with-truncate --env="dev"

#Instalar fixtures producción
bin/console hautelook:fixtures:load --purge-with-truncate --env="prod"
