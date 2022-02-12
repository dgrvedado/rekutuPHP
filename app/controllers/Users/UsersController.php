<?php 

include_once(CORE_PATH.'/index.php');

class UsersController extends Controller {

    private $id_session;

    public function __construct(){
        $this->session = new Session();
        $this->session->init();
        if($this->session->getStatus() !== 2 || empty($this->session->get('id'))) {
            $this->model->logger("SESSION EXPIRADA: ".date('Y-m-d H:i:s'));
            $this->session->close();
            setcookie('rekutu', '', time()-(60*60*24), '/');
            header('Location:'.BASE_URL.'/login');
        }
        parent::__construct(__CLASS__);
    }

    public function index() {
        $this->params = array(
                            'objeto'    => 'index',
                            'users' => $this->model->getUsers()
                            );
        $this->render(__CLASS__, $this->params);
    }

    public function logout() {
        setcookie('rekutu', '', time()-(60*60*24), '/');
        $this->model->logger("SALIO DEL SISTEMA: ".date('Y-m-d H:i:s'));
        $this->session->close();
        header('Location:'.BASE_URL.'/login');
    }

}
