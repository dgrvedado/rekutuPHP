<?php 

if ($_SERVER['SERVER_PORT'] != 80 && $_SERVER['SERVER_PORT'] != 443) {
    $gouri = 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"];
} elseif ($_SERVER['SERVER_PORT'] == 443) {
    $gouri = 'https://'.$_SERVER["SERVER_NAME"];
} else {
    $gouri = 'http://'.$_SERVER["SERVER_NAME"];
}

defined('BASEPATH') or header('Location: '.$gouri);

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
                    $this->session->add('uid',  $login->uid);
                    $this->session->add('type', $login->type);
                    $this->session->add('name', $login->name);
                    if ($this->dat[0]['id'] != 0) {
                        $this->session->add('phrase',        $this->dat[0]['passphrase']);
                        $this->session->add('acronim',       $this->dat[0]['namedb']);
                        $this->session->add('sender',        $this->dat[0]['rucEmpresa']);
                        $this->session->add('id_empresa',    $this->dat[0]['id']);
                        $this->session->add('menu',          $this->verifySecure($this->dat[0]['id']));
                        $this->session->add('empresa',       $this->dat[0]['nomEmpresa']);
                        $this->session->add('namePKey',      $this->dat[0]['namePKey']);
                        $this->session->add('namePKCS12',    $this->dat[0]['namePKCS12']);
                        $this->session->add('nameDNACertWS', $this->dat[0]['nameDNACertWS']);
                        $this->session->add('nameDNACertEM', $this->dat[0]['nameDNACertEM']);
                    }
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
