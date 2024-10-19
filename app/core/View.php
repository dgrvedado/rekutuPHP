 <?php

include_once(CORE_PATH.'/index.php');

/**
* Vista base
*/
class View {
    /**
    * string
    */
    protected $template;
    /**
    * string
    */
    protected $controller_name;
    /**
    * array
    */
    public $params;

    /**
    * Inicializa valores y el render
    * @param string $controller_name
    * @param array $params. Opcional
    */
    public function __construct($controller_name, $params = array(), $pdf) {
        $this->controller_name = $controller_name;
        $this->params = $params;
        if (!$pdf) {
            $this->render();
        } else {
            $this->renderViewPDF();
        }
        
    }


    /**
    * Muestra la vista según el controlador que hizo la petición
    */
    protected function render() {
        if(class_exists($this->controller_name)) {
            $objeto = $this->params['objeto'];
            $this->level = strtolower($this->controller_name);
            $file_name = str_replace('controller', '', $this->level);
            $this->template = $this->getContentTemplate($file_name, $objeto);
            echo $this->template;
        } else {
            throw new Exception("Error No existe $this->controller_name");
        }
    }

    /**
    * Retorna el render de una vista
    */
    protected function getContentTemplate($file_name, $objeto) {
        $wrapper = VIEW_PATH."/".$file_name."/_".THEME.".".$objeto.".php";
        $file_path = THEME_PATH.'/_layout.php';
        array_push($this->params, ['wrapper' => $wrapper]);
        if(is_file($wrapper)){
            extract($this->params);
            ob_start();
            require ($file_path);
            $template = ob_get_contents();
            ob_end_clean();
            return $template;
        }else{
            throw new Exception("Error No existe $file_path");
        }
    }

    public function renderPDF() {
        /*if (strstr($file, 'viewpdf')) {
            require VIEW_PATH.'/'.$level.'/viewpdf.php';
        } else {
            require VIEW_PATH.'/main/_wrapper.main.php';
        }*/

        if(class_exists($this->controller_name)) {
            $objeto = $this->params['objeto'];
            $this->level = strtolower($this->controller_name);
            $file_name = str_replace('controller', '', $this->level);   
            $this->template = $this->getContentPDF($file_name, $objeto);
            echo $this->template;
        } else {
            throw new Exception("Error No existe $this->controller_name");
        }

    }

    /**
    * Retorna el render de una vista PDF
    */
    protected function getContentPDF($file_name, $objeto) {
        $wrapper = VIEW_PATH."/".$file_name."/_".THEME.".".$objeto.".php";
        array_push($this->params, ['wrapper' => $wrapper]);
        if(is_file($wrapper)){
            extract($this->params);
            ob_start();
            require ($wrapper);
            $template = ob_get_contents();
            ob_end_clean();
            return $template;
        }else{
            throw new Exception("Error No existe $this->file_path");
        }
    }

    
}
