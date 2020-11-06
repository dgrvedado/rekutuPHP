# rekutuPHP

Framework sencillo en PHP para aplicaciones sencillas.

Este pequeño framework parte de un empeño personal por tener una herramienta docil y fácil de usar para desarrollos dinámicos y rápidos.

Consta de una estructura basada en Laravel pero sin serlo y también cuenta con las ideas y algunos códigos de dos proyectos educativos:

* [Vida MRR](https://github.com/marcosrivasr/Curso-PHP-MySQL/tree/master/43-49.%20MVC)
* [Develpero](https://github.com/Developero-oficial/php-mvc)

Ambos proyectos fueron ilustradores para el desarrollo de este.

# Instalación

Se debe mover al directorio /var/www del servidor web y realizar los siguientes 
pasos.

1- ***Clonar el proyeto***:

```
git clone https://github.com/dgrvedado/rekutuPHP.git
```

2- ***Crear archivo de configuración***:

```
cp config/config.example.php config/config.php
```

En caso de que Ud decida poner su proyecto en una URL sin directorio de acceso 
deberá proceder como sigue:

```php
define('FOLDER_PATH',     '/rekutuPHP');
```

En caso que si VirtualServer esté apuntando diretamente a su diretorio en el 
DocumentRoot, Ud deberá poner esta Constante de la siguiente forma:

```php
define('FOLDER_PATH',     '');
```

3- ***Editar el archivo config/env.php***:

Aquí deberá definir las variables de sus conexión a la BD tanto de root como del usuario rekutuPHP o el que decida, en el caso de root es impresindible para la creación inicial de bases de datos y el usuario.

Realizada la modificación salve el arhivo y continue con el siguiente paso.
