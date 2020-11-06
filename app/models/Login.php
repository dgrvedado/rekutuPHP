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

class LoginModel extends Model {
    
    public function __construct(){
        parent::__construct();
    }

    /* User Login */
    public function userLogin($username,$password) {
        $db = $this->db->getDBA();
        $hash_password= hash('sha256', $password);
        $stmt = $db->prepare("SELECT uid, type, name, tocken FROM ".DB_DATABASE.".users WHERE  (username=:username OR email=:username) AND  password=:hash_password");
        $stmt->bindParam("username", $username,PDO::PARAM_STR) ;
        $stmt->bindParam("hash_password", $hash_password,PDO::PARAM_STR) ;
        $stmt->execute();
        $data=$stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        if($stmt->rowCount()) {
            //var_dump($data);
            return $data;
        } else {
            return false;
        }
    }

    /* User Registration */
    public function userRegistration($type,$username,$password,$email,$name) {
        try {
        $db = $this->db->getDBA();
        $st = $db->prepare("SELECT uid FROM ".DB_DATABASE.".users WHERE username=:username OR email=:email");
        $st->bindParam("username", $username,PDO::PARAM_STR);
        $st->bindParam("email", $email,PDO::PARAM_STR);
        $st->execute();
        $count=$st->rowCount();
            if($count<1) {
                $stmt = $db->prepare("INSERT INTO ".DB_DATABASE.".users(type,username,password,email,name) VALUES (:type,:username,:hash_password,:email,:name)");
                $stmt->bindParam("username", $username,PDO::PARAM_STR) ;
                $hash_password= hash('sha256', $password);
                $stmt->bindParam("hash_password", $hash_password,PDO::PARAM_STR) ;
                $stmt->bindParam("email", $email,PDO::PARAM_STR) ;
                $stmt->bindParam("name", $name,PDO::PARAM_STR) ;
                $stmt->bindParam("type", $type,PDO::PARAM_STR) ;
                $stmt->execute();
                $uid=$db->lastInsertId();
                $db = null;
                //$_SESSION['uid']=$uid;
                return true;
            } else {
                $db = null;
            }
        } catch(PDOException $e) {
            $xerror = '{"ERROR U0001":{"text":'. $e->getMessage() .'}}';
            return $xerror;
        }
    }

    /* User Details */
    public function details($uid) {
        if ($uid == 0) {
            $sql = "SELECT * FROM ".DB_DATABASE.".users WHERE uid != 1";
        } else {
            $sql = "SELECT * FROM ".DB_DATABASE.".users WHERE uid = $uid";
        }
        try {
            $db = getDBA();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("uid", $uid,PDO::PARAM_INT);
            $stmt->execute();
            if ($uid == 0) {
                while($data[] = $stmt->fetch(PDO::FETCH_ASSOC));
                array_pop($data);
            } else {
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        return $data;
        } catch(PDOException $e) {
            $xerror = '{"ERROR U0003":{"text":'. $e->getMessage() .'}}';
            return $xerror;
        }
    }

}
