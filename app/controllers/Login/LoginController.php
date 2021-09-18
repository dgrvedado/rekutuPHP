<?php 

include_once(CORE_PATH.'/index.php');

class LoginController extends Controller {

    private $session;

    public function __construct() {
        parent::__construct(__CLASS__);
        //$this->name_model = str_replace('Controller', '', __CLASS__);
        //$this->loadModel($this->name_model);
        $this->session = new Session();
    }

    public function index() {
        $this->params = array(
                        'error'  => '', 
                        'objeto' => 'form.login',
                        'title'  => 'Login',
                        'index'  => true);
        $this->render(__CLASS__, $this->params);
    }

    public function singin($request) {
        if  (isset($request['username'])) {
            $login = $this->model->userLogin($request['username'],$request['password']);
            if ($login != false) {

                if ($login->uid == 1 && $request['empresa'] == 0) {
                    $this->dat = $this->model->getEmproy(-1);
                } else if ($login->uid == 1 && $request['empresa']) {
                    $this->dat = $this->model->getEmproy($request['empresa']);
                } else {
                    $this->dat = $this->model->getEmproy($request['empresa']);
                }
                $this->session->putCookie($login->tocken);
                if ($login && $this->dat[0]['id'] != 0) {
                    $this->session->init();
                    $this->session->add('userID',  $login->id);
                    $this->session->add('rolID', $login->id_rol);
                    $this->session->add('name', $login->name);
                    $this->model->loging("INGRESO AL SISTEMA: ".date('Y-m-d H:i:s'));
                    //var_dump($this->session->getStatus());
                    //echo session_id();
                    header('Location:'.BASE_URL.'/main');
                } else {
                    $this->dat = $this->model->getEmproy();
                    $this->params = array(
                            'dat'    => $this->dat,
                            'error'  => 'Login Incorrecto. Acceso Denegado', 
                            'objeto' => 'form.login',
                            'index'  => true);
                    $this->render(__CLASS__, $this->params);
                }    
            } else {
                $this->dat = $this->model->getEmproy();
                $this->params = array(
                        'dat'    => $this->dat,
                        'error'  => 'Empresa Incorrecta. Acceso Denegado', 
                        'objeto' => 'form.login',
                        'index'  => true);
                $this->render(__CLASS__, $this->params);
            }
        }   
    }
} //Cierra Clase Login
