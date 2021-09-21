<?php

require_once(CONTROLLER_PATH.'/ErrorsController.php');

class App {

    function __construct(){

        $url = isset($_GET["url"]) ? $_GET["url"] : null ;
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        $this->session = new Session();

        var_dump($this->session->get('uid'));
        //die();
        if ($this->session->get('uid')) {
            if (empty($url[0]) || $url[0] == 'main') {
                $fileController = CONTROLLER_PATH.'/MainController.php';
                require_once $fileController;
                $controller = new Main();
                $controller->loadModel('Main');
                $controller->render();
                
                return false;
            /*} else if ($url[0] == 'notify') {
                $fileController = CONTROLLER_PATH.'/NotifyController.php';
                require_once $fileController;
                $controller = new Notify();
                $controller->loadModel('Notify');
                $controller->render();*/
            } else {
                $fileController = CONTROLLER_PATH.'/'.ucfirst($url[0]).'Controller.php';
            }
        } else if (empty($this->session->get('uid'))) {
            $fileController = CONTROLLER_PATH.'/LoginController.php';
            require_once $fileController;
            $controller = new Login();
            $controller->loadModel('Login');
            $controller->index();
            return false;
        }

        if(@file_exists($fileController)) {
            require $fileController;
            $nameClass = ucfirst($url[0]);
            $controller = new $nameClass;
            $controller->loadModel(ucfirst($url[0]));
            // Se obtienen el número de param
            $nparam = sizeof($url);
            // si se llama a un método
            if($nparam > 1) {
                // hay parámetros
                if($nparam > 2){
                    //Este sistema no permite el metodo get 
                    //por ende ningun parametro mayor a 2
                    //seria permitido.
                    //El siguiente código es para ejemplo
                    //aunque se dejará para poder manipular.
                    $param = [];
                    for($i = 2; $i < $nparam; $i++){
                        array_push($param, $url[$i]);
                    }
                    $controller->{$url[1]}($param);
                } else {
                    // solo se llama al método
                    // Pero se debe cmprobar si existe
                    if (method_exists($controller, $url[1]) === true) {
                        $controller->{$url[1]}();    
                    } else {
                        $controller = new xError();
                    }
                }
            } else {
                // si se llama a un controlador
                $controller->index();
            }
        } else {
            $controller = new xError();
        }

    }

    function url_exists( $url = NULL ) {

        if( empty( $url ) ){
            return false;
        }

        $ch = curl_init( $url );
     
        // Establecer un tiempo de espera
        curl_setopt( $ch, CURLOPT_TIMEOUT, 5 );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 5 );

        // Establecer NOBODY en true para hacer una solicitud tipo HEAD
        curl_setopt( $ch, CURLOPT_NOBODY, true );
        // Permitir seguir redireccionamientos
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
        // Recibir la respuesta como string, no output
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

        // Descomentar si tu servidor requiere un user-agent, referrer u otra configuración específica
        // $agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36';
        // curl_setopt($ch, CURLOPT_USERAGENT, $agent)

        $data = curl_exec( $ch );

        // Obtener el código de respuesta
        $httpcode = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
        //cerrar conexión
        curl_close( $ch );

        // Aceptar solo respuesta 200 (Ok), 301 (redirección permanente) o 302 (redirección temporal)
        $accepted_response = array( 200, 301, 302 );
        if( in_array( $httpcode, $accepted_response ) ) {
            return true;
        } else {
            return false;
        }

    }
}

?>
