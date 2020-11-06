<?php

//defined('BASEPATH') or exit('No se permite acceso directo');
//
if ($_SERVER['SERVER_PORT'] != 80 && $_SERVER['SERVER_PORT'] != 443) {
    $gouri = 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"];
} elseif ($_SERVER['SERVER_PORT'] == 443) {
    $gouri = 'https://'.$_SERVER["SERVER_NAME"];
} else {
    $gouri = 'http://'.$_SERVER["SERVER_NAME"];
}

defined('BASEPATH') or header('Location: '.$gouri);

spl_autoload_register(function ($class) {
    if(is_file(CORE_PATH."/$class.php"))
        return require CORE_PATH."/$class.php";
    if(is_file(HELPER_PATH."/$class.php"))
        return require HELPER_PATH."/$class.php";
});
