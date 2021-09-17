<?php 

include_once(CORE_PATH.'/index.php');

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
