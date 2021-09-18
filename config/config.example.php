<?php

//defined('BASEPATH') or exit('No se permite acceso directo');
//
include_once(__DIR__.'/index.php');

date_default_timezone_set('America/Asuncion');
//ini_set('memory_limit','512M');

//////////////////////////////////////
// Valores de ruta principal y config
/////////////////////////////////////
define('ROOT',        $_SERVER['DOCUMENT_ROOT']);
define('CONFIG_PATH', ROOT.'/config');

//Toda configuración establecerla en
//'config/database.php'
$arrcf = parse_ini_file(CONFIG_PATH.'/env.php', true);

//////////////////////////////////////
// Valores de base de datos
/////////////////////////////////////
define('DB_DRIVE',      $arrcf['server']['drive']);
define('DB_SERVER',     $arrcf['server']['host']);
define('DB_ROOT',       $arrcf['root']['user']);
define('DB_ROOTPASSWD', $arrcf['root']['pass']);
define('DB_USERNAME',   $arrcf['user']['user']);
define('DB_PASSWD',     $arrcf['user']['pass']);
define('DB_DATABASE',   $arrcf['server']['dbse']);
define('DB_PORT',       $arrcf['server']['port']);

//Ruta de Directorio
define('FOLDER_PATH',   $arrcf['core']['directory']);

//Ruta de Temas
/* 
 * Possibles themes: 
 * - Matrix Panel (matrix) active
 * - AdminLTE (adminlte) active
 * - Metronic (metronic) not active
*/
define('THEME',         $arrcf['core']['theme']);
define('MULTIEMP',      $arrcf['core']['multiem']);
//////////////////////////////////////
// Valores de uri
/////////////////////////////////////
define('URI',            $_SERVER['REQUEST_URI']);
define('REQUEST_METHOD', $_SERVER['REQUEST_METHOD']);

if ($_SERVER['SERVER_PORT'] != 80 && $_SERVER['SERVER_PORT'] != 443) {
    $uri = 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].FOLDER_PATH;
} elseif ($_SERVER['SERVER_PORT'] == 443) {
    $uri = 'https://'.$_SERVER["SERVER_NAME"].FOLDER_PATH;
} else {
    $uri = 'http://'.$_SERVER["SERVER_NAME"].FOLDER_PATH;
}
define('BASE_URL',        $uri);
define('ASSETS_URL',      BASE_URL.'/publics/assets/theme/'.THEME);
define('XML_URL',         BASE_URL.'/resources/xmls');

//////////////////////////////////////
// Mis rutas y Valores de core
/////////////////////////////////////
define('ROOT_PATH',       ROOT.FOLDER_PATH);
define('CORE_PATH',       ROOT_PATH.'/app/core');
define('CLASS_PATH',      ROOT_PATH.'/app/class');
define('CONTROLLER_PATH', ROOT_PATH.'/app/controllers');
define('MODEL_PATH',      ROOT_PATH.'/app/models');
define('HELPER_PATH',     ROOT_PATH.'/app/helpers');
define('LIBS_PATH',       ROOT_PATH.'/app/libs');
define('WSAA_PATH',       ROOT_PATH.'/app/controllers/wsaa');
define('WSAA_LIB_PATH',   ROOT_PATH.'/app/controllers/wsaa/lib');

define('THEME_PATH',      ROOT_PATH.'/resources/views/themes/'.THEME);
define('VIEW_PATH',       ROOT_PATH.'/resources/views');
define('XML_PATH',        ROOT_PATH.'/resources/xmls');
define('PDF_PATH',        ROOT_PATH.'/resources/pdfs');
define('LOG_PATH',        ROOT_PATH.'/resources/logs');

define('LOGIN_CONTROLLER',   'Login');
define('DEFAULT_CONTROLLER', 'Main');
//////////////////////////////////////
// Valores de configuracion
/////////////////////////////////////
define('ERROR_REPORTING_LEVEL', -1);
