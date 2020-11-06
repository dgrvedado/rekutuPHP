<?php

//defined('BASEPATH') or exit('No se permite acceso directo');
//
if ($_SERVER['SERVER_PORT'] != 80 && $_SERVER['SERVER_PORT'] != 443) {
    $gouri = 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"];
} elseif ($_SERVER['SERVER_PORT'] == 443) {
    $gouri = 'https://'.$_SERVER["SERVER_NAME"];
} else {
    $gouri = 'http://'.$_SERVER["SERVER_NAME"];
}

defined('BASEPATH') or header('Location: '.$gouri);

class MainModel extends Model {

    private $schema;

    public function __construct(){
        $this->schema = $_SESSION["schema"];
        parent::__construct();
    }

    public function getExamples() {
        $data = $this->dbQuery("(SELECT CASE WHEN COUNT(*) != 0 THEN COUNT(*) ELSE 0 END AS number  FROM ".$this->schema.".tableA A INNER JOIN ".$this->schema.".tableB B ON A.id = B.id_onA WHERE A.field != '' AND B.dinamic_field = ".$_SESSION['dinamic_field'].") UNION (SELECT CASE WHEN COUNT(*) != 0 THEN COUNT(*) ELSE 0 END AS number  FROM ".$this->schema.".tableA A INNER JOIN ".$this->schema.".tableC xn ON A.id_inA = C.id_onA WHERE C.field_where = 1 AND C.dinamic_field = ".$_SESSION['dinamic_field'].") UNION (SELECT CASE WHEN COUNT(*) != 0 THEN COUNT(*) ELSE 0 END AS number FROM ".$this->schema.".tableA x INNER JOIN ".$this->schema.".tableD D ON A.id = D.id_onA WHERE D.field_where = 0 AND D.dinamic_field = ".$_SESSION['dinamic_field'].") UNION (SELECT CASE WHEN COUNT(*) != 0 THEN COUNT(*) ELSE 0 END AS num FROM ".$this->schema.".B WHERE field_where = 1 AND id_onA = ".$_SESSION['dinamic_field'].")");
        return $data;
    }
    
    public function getExample($id) {
        $data = $this->dbSelect('*',DB_DATBASE.'.table',"id = ".$id);
        return $data;
    }

    public function insert($request) {
        $data = $this->dbInsert($request);
        return $data;
    }

    public function update($request) {
        $data = $this->dbUpdate($request);
        return $data;
    }

    public function delete($request) {
        $data = $this->dbDelete($request);
        return $data;
    }
}
