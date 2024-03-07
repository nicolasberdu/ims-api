# Instalacion

## Dependencias

Primero instale las dependencias con comando
```
composer install
```

## Variables de entorno
Revise su archivo .env y verifique tener las configuraciones de base de datos.
Ejemplo:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ims_api
DB_USERNAME=root
DB_PASSWORD=
```

## Migraciones
Luego corra las migraciones del proyecto con
```
php artisan migrate
```

## Levantar servidor
Por ultimo levante el servidor
```
php artisan serve
```