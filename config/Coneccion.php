<?php

include_once(__DIR__.'/index.php');

class Conex {

    private $db_host;
    private $db_port;
    private $db_root;
    private $db_poot;
    private $db_user;
    private $db_pass;
    private $db_name;
    private $db_drive;

    public function __construct() {
        $this->db_host  = DB_SERVER;
        $this->db_port  = DB_PORT;
        $this->db_root  = DB_ROOT;
        $this->db_poot  = DB_ROOTPASSWD;
        $this->db_user  = DB_USERNAME;
        $this->db_pass  = DB_PASSWD;
        $this->db_name  = DB_DATABASE;
        $this->db_drive = DB_DRIVE;
    }

    public function getDB() {
        try {
            $Connex = new PDO($this->db_drive.":host=".$this->db_host.";port=".$this->db_port,$this->db_user, $this->db_pass);
            $Connex->exec("SET NAMES utf8mb4");
            $Connex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $Connex;
        } catch (PDOException $e) {
            echo 'Conexión fallida: '.$e->getMessage();
        }
    }

    public function getDBi() {
        try {
            $Connex = new PDO($this->db_drive.":host=".$this->db_host.";port=".$this->db_port,$this->db_root, $this->db_poot);
            $Connex->exec("SET NAMES utf8mb4");
            $Connex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $Connex;
        } catch (PDOException $e) {
            echo 'Conexión fallida: '.$e->getMessage();
        }
    }
}
