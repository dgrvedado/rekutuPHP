<?php

include_once(CORE_PATH.'/index.php');

spl_autoload_register(function ($class) {
    if(is_file(CORE_PATH."/$class.php"))
        return require CORE_PATH."/$class.php";
    if(is_file(HELPER_PATH."/$class.php"))
        return require HELPER_PATH."/$class.php";
});
