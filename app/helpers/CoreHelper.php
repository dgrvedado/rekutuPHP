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
/**
* 
*/
class CoreHelper {
    
    public static function validateController($controller) {
        if(!is_file(CONTROLLER_PATH."/{$controller}/{$controller}Controller.php"))
            return false;
        return true;
    }

    public static function validateMethodController($controller, $method) {
        if(!method_exists($controller, $method))
            return false;
        return true;
    }
}
