<?php 

$dir = explode('/', $_SERVER['REQUEST_URI']);
//var_dump($_SERVER); die();

defined('BASEPATH') or exit(header('Location:http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].'/'.$dir[1].'/login'));
