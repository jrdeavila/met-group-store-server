# Servidor de recursos API para Store App

Es donde se aloja la logica backend del ultimo ejercicio planteado
en la prueba de desarrollador. Que permite realizar las tareas crud
de los modulos Stores e Items, ademas de un sistema de autenticacion
de usuarios.

Esta aplicación está desarrollada con Laravel-PHP, Laravel-Passport, Docker,
Clean Arquitecture y buenas practicas de programacion para la creacion
de un servicio de calidad y de facil mantenimiento.

## Entorno de ejecucion

Para poder correr el servidor, debemos tener instaladas las
siguientes dependencias:

-   Docker
-   PHP CLI
-   node
-   Composer

Ademas, tenemos que asegurarnos de que el servicio de Docker
este ejecutandose.
En windows abrimos el entorno de Docker y nos aseguramos de que
asi sea.

_Nota: Para el caso de Linux debemos ejecutar el siguiente comando_

```
sudo systemctl start docker
```

_Esto ejecutará el servicio de docker en segundo plano_

Luego debemos instalar las dependencias de node. Para ello, nos
situamos en la raiz del proyecto y ejecutamos el siguiente comando.

```
npm install && npm run dev
```

Instalamos Laravel-Sail.

```
php artisan sail:install
```

_Aqui escogemos a MySQL como base de datos_

Instalamos las dependencias del proyecto.

```
sail composer install
```

Seguidamente corremos las migraciones.

```
sail artisan migrate
```

Y por ultimo registramos los clientes de passport.
Para ello ejecutamos el siguiente comando.

```
sail artisan passport:install
```

_Esto hara que se guarden en la base de datos dos clientes
de passport. El Personal Access Token y el Client Access Token
respectivamente._

En este punto solo debemos agregar o actualizar las variables
de entorno `PERSONAL_ACCESS_CLIENT_SECRET` y `PERSONAL_ACCESS_CLIENT_ID`
con la informacion previa.

Y listo, ya podemos consumir los recursos del servidor de forma
local `http://localhost`. En donde podemos usar los siguientes endpoints:

| Endpoint                  | Metodos                        | Descripcion                                                               |
| ------------------------- | ------------------------------ | ------------------------------------------------------------------------- |
| http://localhost/register | `POST`                         | Registra un nuevo usuario                                                 |
| http://localhost/auth     | `POST`                         | Obtiene un token de acceso con las credenciales de un usuario registrado. |
| http://localhost/store    | `GET`, `POST`,`PUT`, `DELETE`, | Crud de S                                                                 |

tores.
http://localhost/item | `GET`, `POST`,`PUT`, `DELETE`,| Crud de Items.

## Features

-   Laravel-PHP
-   Docker
-   Passport / OAuth2
-   Arquitectura Limpia
-   Principios SOLID

## Authors

-   [@jrdeavila](https://www.github.com/octokatherine)
