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
            //echo "<pre>"; var_dump($login); echo "</pre>"; exit;
            if ($login != false) {
                $this->session->putCookie($login->token);
                $this->session->init();
                $this->session->add('id',  $login->id);
                $this->session->add('id_rol', $login->id_rol);
                $this->session->add('username', $login->username);
                $this->model->logger("INGRESO AL SISTEMA: ".date('Y-m-d H:i:s'));
                //var_dump($this->session->getStatus());
                //echo session_id();
                header('Location:'.BASE_URL.'/home');
            } else {
                $this->params = array(
                        'error'  => 'Login Incorrecto. Acceso Denegado',
                        'objeto' => 'form.login',
                        'index'  => true);
                $this->render(__CLASS__, $this->params);
            }
        }   
    }
} //Cierra Clase Login
