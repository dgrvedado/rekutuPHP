<?php

if ($_SERVER['SERVER_PORT'] != 80 && $_SERVER['SERVER_PORT'] != 443) {
    $gouri = 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"];
} elseif ($_SERVER['SERVER_PORT'] == 443) {
    $gouri = 'https://'.$_SERVER["SERVER_NAME"];
} else {
    $gouri = 'http://'.$_SERVER["SERVER_NAME"];
}

defined('BASEPATH') or header('Location: '.$gouri);

/**
* Controlador base
*/
abstract class Controller {
    /**
   * @var object
   */
    private $view;

    public function __construct($class_name){
        $this->name_model = str_replace('Controller', '', $class_name);
        $this->loadModel($this->name_model);
    }
   
    /**
    * Metodo estándar
    **/
    abstract public function index();
   
    /**
    * Inicializa la vista
    **/
    public function render($controller_name = '', $params = array()) {
        $this->view = new View($controller_name, $params, false);
    }

    /**
    * Inicializa la vista PDF
    **/
    public function renderPDF($controller_name = '', $params = array()) {
        $this->view = new View($controller_name, $params, true);
    }

    /**
    * Llamaada al Modelo
    **/
    public function loadModel($model) {
        $file_path = MODEL_PATH.'/'.$model.'.php';
        if(file_exists($file_path)){
            require ($file_path);
            $modelName = $model.'Model';
            $this->model = new $modelName();
        }
    }
}
