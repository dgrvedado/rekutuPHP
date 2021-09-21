<?php 

include_once(CORE_PATH.'/index.php');

class ExampleController extends Controller {

    private $uid_session;

    public function __construct(){
        $this->session = new Session();
        $this->session->init();
        $this->schema     = $_SESSION['schema'];
        $this->id_session = $_SESSION['id'];
        if($this->session->getStatus() !== 2 || empty($this->session->get('id'))) {
            $this->model->logger("EXPIRED SESSION: ".date('Y-m-d H:i:s'));
            $this->session->close();
            setcookie('rekutu', '', time()-(60*60*24), '/');
            header('Location:'.BASE_URL.'/login');
        }
        parent::__construct(__CLASS__);
    }

    public function index() {
        //echo "<center>"; echo SENDER; echo "</center>";
        if ($this->uid_session != 1) {
            $this->getexamples = $this->model->getExamples();
        } else {
            $this->getexamples = false;
        }
        
        $this->params = array(
                            'objeto'      => 'example',
                            'getexamples' => $this->getexamples
                            );
        $this->render(__CLASS__, $this->params);
    }

    public function logout() {
        setcookie('rekutu', '', time()-(60*60*24), '/');
        $this->model->loging("LOGOUT SYSTEM: ".date('Y-m-d H:i:s'));
        $this->session->close();
        header('Location:'.BASE_URL.'/login');
    }

    public function result($request) {
        $this->variable = $request['variable'];
        $this->message  = $request['message'];
        
        /*En la vista result, podeos pasar varaibles para dejar cadenas o datos */
        if (@$this->variable == true) {
            $this->title = "Title for True";
            $this->url   = BASE_URL."/controller/method";
        } else {
            $this->title = "Title for False";
            $this->url   = BASE_URL."/controller/othermethod";
        }

        /*Se puede pasar condiciones para css o bootstraps */
        if (strstr($this->mensaje, " true ")) {
            $this->alert = "alerts-true"; 
        } else { 
            $this->alert = "alerts-false"; 
        }

        if (strstr($this->mensaje, "string")) {
            $this->action = "String ";
        } else if (strstr($this->mensaje, "strong")) {
            $this->action = "Strong ";
        } else if (strstr($this->mensaje, "streng")) {
            $this->action = "Streng ";
        } else {
            $this->action = "";
        }
        $this->params = array(
                        'message' => $this->message,
                        'url'     => $this->url,
                        'alert'   => $this->alert,
                        'acc'     => $this->action,
                        'title'   => $this->title,
                        'objeto'  => 'result'
                        );
        $this->render(__CLASS__, $this->params);
    }

}
