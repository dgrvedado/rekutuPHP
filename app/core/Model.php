<?php

include_once(CORE_PATH.'/index.php');

/**
 * Modelo base
 */
class Model {

    /**
    * @var object
    */
    protected $db;

    private $schema;

    /**
    * Inicializa conexion
    */
    public function __construct(){
        $this->schema = @$_SESSION['acronim'];
        $this->db     = new Conex();
        //var_dump($this->db);

    }

    public function logger($data) {
        if (@$_SESSION['id']) {
            $this->id = $_SESSION['id'];
        } else {
            $this->id = $this->dbSelect('id',DB_DATABASE.'.users',"tocken LIKE '".$_COOKIE["rekutu"]."'" );
            //var_dump($this->suid); die();
            $this->id = $this->id[0]['id'];
        }
        try {
            $db = $this->db->getDB();
            $accion = base64_encode($data);
            $sql = "INSERT INTO ".DB_DATABASE.".logger (fecha, accion, usuario) VALUE (NOW(),'".$accion."', '".$uid."')";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $db = null;
        } catch(PDOException $e) {
            return '<b>"ERROR No.0001"</b>: ('.$e->getMessage().')';
        }
    }


    /* Query General. Aquellos querys muy complejos se pueden pasar en esta funcion */
    public function dbQuery($query) {
        try {
            $db = $this->db->getDB();
            $stmt = $db->prepare($query);
            //echo "SELECT $field FROM $table WHERE $where";
            //$stmt->bindParam("field", $field,PDO::PARAM_INT);
            //$stmt->bindParam("table", $table,PDO::PARAM_INT);
            //$stmt->bindParam("where", $where,PDO::PARAM_INT);
            $stmt->execute();
            while($data[] = $stmt->fetch(PDO::FETCH_ASSOC));
            array_pop($data);
            return $data;
        } catch(PDOException $e) {
            $xerror = '<b>"ERROR No.0002"</b>: ('.$e->getMessage().')';
            return $xerror;
        }
    }

    /* SELECT. Es un Select general de cualquier Tabla que se pase el parametro */
    public function dbSelect($field,$table,$where) {
        try {
            $db = $this->db->getDB();
            $stmt = (empty($where)) ? $db->prepare("SELECT ".$field." FROM ".$table) : $db->prepare("SELECT ".$field." FROM ".$table." WHERE ".$where);
            //echo "SELECT $field FROM $table WHERE $where";
            //$stmt->bindParam("field", $field,PDO::PARAM_INT);
            //$stmt->bindParam("table", $table,PDO::PARAM_INT);
            //$stmt->bindParam("where", $where,PDO::PARAM_INT);
            $stmt->execute();
            while($data[] = $stmt->fetch(PDO::FETCH_ASSOC));
            array_pop($data);
            return $data;
        } catch(PDOException $e) {
            $xerror = '<b>"ERROR No.0003"</b>: ('.$e->getMessage() .')';
            return $xerror;
        }
    }
    
    /* DELETE. Delete general para cualquier tabla que se pase en el array request */
    public function dbDelete($request) {
        try {
            $db = $this->db->getDB();
            $sql = "DELETE FROM ".$request["table"]." WHERE ".$request["where"];
            //echo $sql; exit;
            $stmt = $db->prepare($sql);
            //$stmt->bindParam("id", $id,PDO::PARAM_INT);
            $stmt->execute();
            $this->loging($sql);
            $db = null;
            return true;
        }
        catch(PDOException $e) {
            $xerror = '<b>"ERROR No.0004"</b>: ('.$e->getMessage().')';
            return $xerror;
          }
     }

    /* UPDATE. Update general para cualquier tabla que se pase en el array request */
    public function dbUpdate($request) {
        try {
            $db = $this->db->getDB();
            //echo "UPDATE ".$request['table']." SET ".$request['data']." WHERE ".$request['where'];
            $sql = "UPDATE ".$request['table']." SET ".$request['data']." WHERE ".$request['where'];
            $stmt = $db->prepare($sql);
            //print_r($stmt);
            //$stmt->bindParam("field", $field,PDO::PARAM_INT);
            //$stmt->bindParam("table", $table,PDO::PARAM_INT);
            //$stmt->bindParam("where", $where,PDO::PARAM_INT);
            $stmt->execute();
            $this->loging($sql);
            $db = null;
            return true;
        } catch(PDOException $e) {
            $xerror = '<b>"ERROR No.0005"</b>: ('.$e->getMessage().')';
            return $xerror;
        }
    }
    
    /* INSERT. Insert general para cualquier tabla que se pase en el array request */
    public function dbInsert($request) {
        try {
            $db = $this->db->getDB();
            $sql = "INSERT INTO ".$request['table']." (".$request['field'].") VALUES (".$request['data'].")";
            //echo $sql; //exit;
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $this->loging($sql);
            $db = null;
            return true;
        } catch(PDOException $e) {
            $xerror = '<b>"ERROR No.0006"</b>: ('.$e->getMessage().')';
            return $xerror;
        }
    }

    public function fixDate($fecha) {
        /*
            Las fechas pueden venir de diferente forma
            2019-01-01 - Modo Inglés
            01/01/2019 - Modo Castellano
            01-01-2019 - Modo Ingles-Castellano
            01012019 - Modo Continuo
            1. Contamos la cantidad de caracteres
            2. Segun la cantidad entonces debemos analizar las diferentes formas
            3. Se debe crear el formato para la BD (AAAA-MM-DD)
        */
        $num = strlen($fecha);

        switch ($num) {
            case 10:
                //Ahora se verifica el modo
                //Vamos si tiene / o -
                if (strstr($fecha,"/")) {
                    $dat = explode("/", $fecha);
                    if (strlen($dat[0]) == 4) {
                        $year = $dat[0];
                        $month = $dat[1];
                        $day = $dat[2];
                    } else if(strlen($dat[0]) == 2) {
                        $year = $dat[2];
                        $month = $dat[1];
                        $day = $dat[0];
                    }
                } else if (strstr($fecha,"-")) {
                    $dat = explode("-", $fecha);
                    if (strlen($dat[0]) == 4) {
                        $year = $dat[0];
                        $month = $dat[1];
                        $day = $dat[2];
                    } else if(strlen($dat[0]) == 2) {
                        $year = $dat[2];
                        $month = $dat[1];
                        $day = $dat[0];
                    }
                }
                break;
            case 8:
                //Asumimos siempre DDMMAAAA
                $year = substr($fecha, 4);
                $month = substr($fecha, 2, -4);
                $day = substr($fecha, 0, -6);
                break;
            default:
                # code...
                break;
        }
        $fixdate = $year."-".$month."-".$day;
        return $fixdate;
    }

}
