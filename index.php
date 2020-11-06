<?php

define('BASEPATH', true);

require (__DIR__."/config/config.php");
require (CONFIG_PATH."/Coneccion.php");
require (CORE_PATH."/autoload.php");
require (LIBS_PATH."/Sesiones.php");

/**
 * Nivel de errores notificados
 */
error_reporting(ERROR_REPORTING_LEVEL);
/**
 * Inicializa Router y detección de valores de la URI
 */
$router     = new Router();
$controller = $router->getController();
$method     = $router->getMethod();
$param      = $router->getParam();

/**
 * Validaciones e inclusión del controlador y el metodo 
 */
//var_dump(CoreHelper::validateController($controller));
if(!CoreHelper::validateController($controller)) 
    $controller = 'ErrorPage';

require CONTROLLER_PATH."/{$controller}/{$controller}Controller.php";

$controller .= 'Controller';

if(!CoreHelper::validateMethodController($controller, $method))
    $method = 'index';

/**
 * Ejecución final del controlador, método y parámetro obtenido por URI
 */
$controller = new $controller;
$controller->$method($param);
