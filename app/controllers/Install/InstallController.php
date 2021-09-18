<?php 

include_once(CORE_PATH.'/index.php');

class InstallController extends Controller {

    public function __construct() {
        parent::__construct(__CLASS__);
        //$this->name_model = str_replace('Controller', '', __CLASS__);
        //$this->loadModel($this->name_model);
    }

    public function index() {
        $this->params = array(
                        'error'   => '',
                        'objeto'  => 'index',
                        'title'   => 'Install',
                        'install' => true);
        $this->render(__CLASS__, $this->params);
    }

    public function install() {
        if($this->model->createDataBase() === true) {
            if($this->model->createDataBase() === true)
            $this->result(['a' => $a, 'mensaje' => $sujeto.' eliminado']);
        } else {
            $this->result(['a' => $a, 'mensaje' => $sujeto.' no eliminado']);
        }


                $this->dat = $this->model->getEmproy();
                $this->params = array(
                        'dat'    => $this->dat,
                        'error'  => 'Empresa Incorrecta. Acceso Denegado', 
                        'objeto' => 'form.login',
                        'index'  => true);
                $this->render(__CLASS__, $this->params);
    }

    public function result($request) {
        $this->a = $request['a'];
        if ($this->a == "C") {
            $this->title = "Socios de Negocio (Clientes)";
            $this->url = "listclients";
            $this->cat = "C";
        } else {
            $this->title = "Socios de Negocio (Shipper's)";
            $this->url = "listshippers";
            $this->cat = "S";
        }

        $this->mensaje = $request['mensaje'];

        if (strstr($this->mensaje, " no ")) {
            $this->alert = "alert-danger";
        } else {
            $this->alert = "alert-success";
        }

        if (strstr($this->mensaje, "cread")) {
            $this->Acc = "Crear ";
        } else if (strstr($this->mensaje, "actualizad")) {
            $this->Acc = "Actualizar ";
        } else if (strstr($this->mensaje, "eliminad")) {
            $this->Acc = "Eliminar ";
        } else {
            $this->Acc = "";
        }
        $this->params = array(
                        'mensaje' => $this->mensaje,
                        'alert'   => $this->alert,
                        'acc'     => $this->Acc,
                        'title'   => $this->title,
                        'url'     => $this->url,
                        'cat'     => $this->cat,
                        'objeto'  => 'result'
                        );
        $this->render(__CLASS__, $this->params);
    }
}
