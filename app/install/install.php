<?php

define('BASEPATH', true);

$arrdb = parse_ini_file(__DIR__.'/../../config/env.php', true);

//////////////////////////////////////
// Valores de base de datos
/////////////////////////////////////
define('DB_SERVER',     $arrdb['server']['host']);
define('DB_ROOT',       $arrdb['root']['user']);
define('DB_ROOTPASSWD', $arrdb['root']['pass']);
define('DB_USERNAME',   $arrdb['user']['user']);
define('DB_PASSWD',     $arrdb['user']['pass']);
define('DB_DATABASE',   $arrdb['server']['dbse']);
define('DB_PORT',       $arrdb['server']['port']);
define('DB_DRIVE',      $arrdb['server']['drive']);

include (__DIR__.'/../../config/Coneccion.php');

$Srv = new Conex();
$server = $Srv->getDBi();

//Pasos para la instalaion
//1- Creccion de la BD en blanco:
$sql  = "CREATE DATABASE ".DB_DATABASE.";";
$stmt = $server->prepare($sql);
$stmt->execute();

//2- Creacion del usuario y contraseña.
$sql  = "CREATE USER '".DB_USERNAME."'@'localhost' IDENTIFIED BY '".DB_PASSWD."';";
$stmt = $server->prepare($sql);
$stmt->execute();

//3- Permisos para la BD
$sql  = "GRANT ALL PRIVILEGES ON ".DB_DATABASE.".* TO '".DB_USERNAME."'@'localhost';";
$stmt = $server->prepare($sql);
$stmt->execute();

$sql  = "FLUSH PRIVILEGES;";
$stmt = $server->prepare($sql);
$stmt->execute();

//4- Importacion de los datos
$host = gethostname();
$ip   = gethostbyname($host);
$command = shell_exec('mysql -h localhost -u '.DB_USERNAME.' -p'.DB_PASSWD.' '.DB_DATABASE.' < '.__DIR__.'/'.DB_DATABASE.'.sql');
echo $command."\n\r";
echo "Please access on you're browser to: http://".$ip."/".$arrdb['core']['directory']."/\n\r";
echo "And login whit 'admin' user\n\r";
