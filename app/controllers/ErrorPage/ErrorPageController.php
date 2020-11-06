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
* Clase de Errores
*/
class ErrorPageController extends Controller {

    //public $path_inicio;

    public function __construct(){
        //parent::__construct();
        //$this->path_inicio = FOLDER_PATH;
        $this->params = array(
                            'number'  => '404', 
                            'mensaje' => 'PAGE NOT FOUND !',
                            'objeto'  => 'errorpage',
                            'index'   => true);
        $this->render(strtolower(__CLASS__), $this->params);
        
    }

    public function index() {
        //$this->view->index = true;
        //$this->view->renderView('errors','index');

        //$this->render(__class__, array('path_inicio' => $this->path_inicio));
    }

}
