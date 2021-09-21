<?php

include_once(CORE_PATH.'/index.php');

/**
* Identificacion de la URI
* Es improtante que si el URI carece de un directorio los indices 
* $this->uri se restarán en 1.
*/
class Router {
    /**
    * @var string
    */
    public $uri;
    /**
    * @var string
    */
    public $controller;
    /**
    * @var string
    */
    public $method;
    /**
    * @var string
    */
    public $param;
    /**
    * Inicializa los atributos
    */
    public function __construct() {
        $this->setUri();
        $this->setController();
        $this->setMethod();
        $this->setParam();
    }
    /**
    * Asigna la uri completa
    */
    public function setUri() {
        $this->uri = explode('/', URI);
    }
    /**
    *Asigna el nombre del controlador
    */
    public function setController() {
        if (FOLDER_PATH != '') {
            $this->controller = $this->uri[2] === '' ? LOGIN_CONTROLLER : ucfirst($this->uri[2]);
        } else {
            $this->controller = $this->uri[1] === '' ? LOGIN_CONTROLLER : ucfirst($this->uri[1]);
        }
        
    }
    /**
    * Asigna el nombre del metodo
    */
    public function setMethod() {
        if (FOLDER_PATH != '') {
            $this->method = ! empty($this->uri[3]) ? $this->uri[3] : 'index';
        } else {
            $this->method = ! empty($this->uri[2]) ? $this->uri[2] : 'index';
        }
    }
    /**
    * Asigna el valor del parametro si existe segun el metodo de peticion
    */
    public function setParam() {
        if(REQUEST_METHOD === 'POST')
            $this->param = $_POST;
        else if (REQUEST_METHOD === 'GET')
            //$this->param = ! empty($this->uri[4]) ? $this->uri[4] : '';
            //header('Location:'.BASE_URL.'/main');
            $this->param = '';
    }
    /**
    * @return $uri
    */
    public function getUri() {
        return $this->uri;
    }
    /**
    * @return $controller
    */
    public function getController() {
        return $this->controller;
    }
    /**
    * @return $method
    */
    public function getMethod() {
        return $this->method;
    }
    /**
    * @return $param
    */
    public function getParam() {
        return $this->param;
    }
}
