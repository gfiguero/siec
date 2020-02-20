# Sistema Integrado de Estadísticas de Carabineros - SIEC
Versión de prueba

Comandos útiles:

#Actualizar repositorio local
```bash
$ git pull origin master
```

#Actualización de esquema de base de datos
```bash
$ bin/console doctrine:schema:update --force
```

#Actualizar modulos Node.js
```bash
$ npm update
```

#Actualización de composer
```bash
$ composer update
```

#Actualización de composer optimizando módulos en producción
```bash
$ composer.phar install --no-dev --optimize-autoloader
```

#Compilar scripts con webpack en desarrollo
```bash
$ yarn encore dev
```

#Compilar scripts con webpack en producción
```bash
$ yarn encore production
```

#Instalar fixtures desarrollo
```bash
$ bin/console hautelook:fixtures:load --purge-with-truncate --env="dev"
```

#Instalar fixtures producción
```bash
$ bin/console hautelook:fixtures:load --purge-with-truncate --env="prod"
```
