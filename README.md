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

> Ojo: Github ha hecho cambios en su política de acceso a los repos vía http/s

2- ***Editar el archivo config/env.php***:

Aquí deberá definir las variables de sus conexión a la BD tanto de root como del usuario rekutuPHP o el que decida, en el caso de root es impresindible para la creación inicial de bases de datos y el usuario.

Realizada la modificación salve el arhivo y continue con el siguiente paso.

3- ***Ejecución de la Instalación Primaria***:

Ejecute el siguiente comndo en la consola:

```
php -f app/inistall/install.php
```

4- ***Crear archivo de configuración***:

```
cp config/config.example.php config/config.php
```

Por lo general los sigueintes pasos no son necesarios realizarlos sin embargo, los exponemos para el conocimiento general de los entusiastas que deseen usar **rekutuPHP**

Es importante tener una buena configuración, en ocaciones deseamos probar el proyecto antes de pasarlo a producción. Recomendamos cambiar la siguiente configuración (*línea 14*):

```php
define('CONFIG_PATH', __DIR__);
```

# Personalizar Plantilla

Puede utilizar cualquier template o plantilla, en nuestro ejemplo usaremos [Matrix Admin Panel](https://matrixadmin.wrappixel.com/).

Definido que plantilla usaremos, debemos solamente desmembrar el template para ser usado como plantilla en todo nuestro proyecto.

Directorio: /resources/views/themes/matrix/

'matrix' puede ser el nombre de su tema o template.

En dependencia de las secciones que Ud desee realizar, yo propongo la siguiente seccionamiento:
* '_foot.php'    -> Pié de cada página, este va incluido en _wrapper.php
* '_footers.php' -> Final de cada página con los JS para el proyecto en general.
* '_head.php'    -> Encabezado para el Layout del Login
* '_headers.php' -> Encabezado para el Layout dentro del sistema
* '_layout.php'  -> Esqueleto completo de la plantilla
* '_leftbar.php' -> Barra del Menu Lateral Izquierdo
* '_navbar.php'  -> Barra de Navegación superior
* '_wrapper.php' -> Contenido en concreto de cada página

En este caso el archivo principal será '_layout.php' el mismo tendrá los include de cada una de las secciones antes mencionadas.


# Explicación del Sistema

Basamos el funcionamiento en un index que siempre recibirá todas las solicitudes request, por medio del .htaccess que redirige todas al index en si. El index chequeará si por medio de un autload las funciones existentes por medio de las rutas definidas en la URL, y de ella saldrán los controladores y métodos a ser usados. 

Toda esta lógica se basa en la siguiente estructura:

* '/app/core' -> Directorio del nucleo del sistema. Posee varios archivos 'autoload.php', 'Controller.php', 'Model.php', 'Router.php' y 'View.php'. En todo caso index parte del llamado de autoload y el mismo será quien cargue todas las funciones de los diferentes archivos.

    * 'Router.php' -> Define las rutas del sistema, evaluando si existe la clase y las funciones que serán parte de las rutas a ser accedidas.

    * 'Controller.php' -> Sería el Controlador principal que posee la carga del modelo propio y de las vistas definidas dentro del controlador de cada sección.

    * 'Model.php' -> Sería el modelo principal con acceso a la conexión a la BD, y las funciones que realizan las tareas generales de ABM en la BD del sistema.

    * 'View.php' -> No es más que la lógica que arma las vistas de cada función del controlador.

* '/app/helpers/' -> Directorio que contiene un archivo para verificar que existen los metodos y funciones.

* '/app/controllers' -> Se crearán todas las carpetas por cada controlador y dentro el archivo controlador con la forma 'NombreController.php'

* '/app/models'      -> Se creará archivos por cada controlador si lo requiere 
