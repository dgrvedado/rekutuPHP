<?php

include_once(CORE_PATH.'/index.php');

class InstallModel {
    
    private $db_host;
    private $db_port;
    private $db_root;
    private $db_poot;
    private $db_user;
    private $db_pass;
    private $db_drive;

    public function __construct()
    {
        $this->db_host  = DB_SERVER;
        $this->db_port  = DB_PORT;
        $this->db_root  = DB_ROOT;
        $this->db_poot  = DB_ROOTPASSWD;
        $this->db_user  = DB_USERNAME;
        $this->db_pass  = DB_PASSWD;
        $this->db_name  = DB_DATABASE;
        $this->db_drive = DB_DRIVE;
    }

    private function getDBInstall()
    {
        try {
            $Srv = new PDO($this->db_drive.":host=".$this->db_host.";port=".$this->db_port,$this->db_root, $this->db_poot);
            $Srv->exec("SET NAMES utf8mb4");
            $Srv->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $Srv;
        } catch (PDOException $e) {
            echo 'Conexión fallida: '.$e->getMessage();
        }
    }

    private function chkDataBase()
    {
        try {
            $dbi  = $this->getDBInstall();
            $sql  = "SHOW DATABASES LIKE '".DB_DATABASE."'";
            $stmt = $dbi->prepare($sql);
            $stmt->execute();
            $data = ($stmt->rowCount() >= 1) ? true : false;
            $this->dbi = null;
            return $data;
        } catch(PDOException $e) {
            return '<b>"ERROR No.1000"</b>: ('.$e->getMessage().')';
        }
    }

    private function createDataBase()
    {
        try {
            $dbi  = $this->getDBInstall();
            $sql  = "CREATE DATABASE ".DB_DATABASE;
            $stmt = $dbi->prepare($sql);
            $stmt->execute();
            $data = ($stmt->rowCount() >= 1) ? true : false;
            return $data;
            $dbi = null;
        } catch(PDOException $e) {
            return '<b>"ERROR No.2000"</b>: ('.$e->getMessage().')';
        }
    }

    private function chkMyUser()
    {
        try {
            $dbi  = $this->getDBInstall();
            $sql  = "SELECT User FROM mysql.user WHERE User LIKE '.DB_USERNAME.'";
            $stmt = $dbi->prepare($sql);
            $stmt->execute();
            $data = ($stmt->rowCount() >= 1) ? true : false;
            return $data;
            $dbi = null;
        } catch(PDOException $e) {
            return '<b>"ERROR No.2000"</b>: ('.$e->getMessage().')';
        }
    }

    private function createMyUser()
    {
        try {
            $dbi  = $this->getDBInstall();
            /*Crear Usuario MySQL*/
            $sql  = "CREATE USER '".DB_USERNAME."'@'localhost' IDENTIFIED BY '".DB_PASSWD."';";
            $stmt = $dbi->prepare($sql);
            $stmt->execute();
            /*Permisos de Usuario MySQL*/
            $sql  = "GRANT ALL PRIVILEGES ON ".DB_DATABASE.".* TO '".DB_USERNAME."'@'localhost';";
            $stmt = $dbi->prepare($sql);
            $stmt->execute();
            /*Refrescando Privilegios MySQL*/
            $sql  = "FLUSH PRIVILEGES;";
            $stmt = $dbi->prepare($sql);
            $stmt->execute();
            $dbi = null;
        } catch(PDOException $e) {
            return '<b>"ERROR No.2001"</b>: ('.$e->getMessage().')';
        }
    }
}
