<?php 

if ($_SERVER['SERVER_PORT'] != 80 && $_SERVER['SERVER_PORT'] != 443) {
    $gouri = 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"];
} elseif ($_SERVER['SERVER_PORT'] == 443) {
    $gouri = 'https://'.$_SERVER["SERVER_NAME"];
} else {
    $gouri = 'http://'.$_SERVER["SERVER_NAME"];
}

defined('BASEPATH') or header('Location: '.$gouri);

class MainController extends Controller {

    private $uid_session;

    public function __construct(){
        $this->session = new Session();
        $this->session->init();
        $this->schema      = @$_SESSION['acronim'];
        $this->uid_session = @$_SESSION['uid'];
        if($this->session->getStatus() !== 2 || empty($this->session->get('uid'))) {
            $this->model->loging("SESSION EXPIRADA: ".date('Y-m-d H:i:s'));
            $this->session->close();
            setcookie('gdflux', '', time()-(60*60*24), '/');
            header('Location:'.BASE_URL.'/login');
        }
        parent::__construct(__CLASS__);
    }

    public function index() {
        //echo "<center>"; echo SENDER; echo "</center>";
        if ($this->uid_session != 1) {
            $this->dashboard = $this->model->getDashboard();
        } else {
            $this->dashboard = false;
        }
        
        $this->params = array(
                            'objeto'    => 'main',
                            'dashboard' => $this->dashboard
                            );
        $this->render(__CLASS__, $this->params);
    }

    public function logout() {
        setcookie('gdflux', '', time()-(60*60*24), '/');
        $this->model->loging("SALIO DEL SISTEMA: ".date('Y-m-d H:i:s'));
        $this->session->close();
        header('Location:'.BASE_URL.'/login');
    }

}
