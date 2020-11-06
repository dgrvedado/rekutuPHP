<?php

if ($_SERVER['SERVER_PORT'] != 80 && $_SERVER['SERVER_PORT'] != 443) {
    $gouri = 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"];
} elseif ($_SERVER['SERVER_PORT'] == 443) {
    $gouri = 'https://'.$_SERVER["SERVER_NAME"];
} else {
    $gouri = 'http://'.$_SERVER["SERVER_NAME"];
}

defined('BASEPATH') or header('Location: '.$gouri);

class Conex {

    private $db_host;
    private $db_port;
    private $db_user;
    private $db_pass;
    private $db_name;
    private $db_drive;

    public function __construct() {
        $this->db_host  = DB_SERVER;
        $this->db_port  = DB_PORT;
        $this->db_user  = DB_USERNAME;
        $this->db_pass  = DB_PASSWD;
        $this->db_name  = DB_DATABASE;
        $this->db_drive = DB_DRIVE;
    }

    public function getDBAInstall() {
        $this->db_host  = DB_SERVER;
        $this->db_port  = DB_PORT;
        $this->db_user  = DB_ROOT;
        $this->db_pass  = DB_ROOTPASSWD;
        $this->db_drive = DB_DRIVER;
        try {
            $Connex = new PDO($this->db_drive.":host=".$this->db_host.";port=".$this->db_port,$this->db_user, $this->db_pass);
            $Connex->exec("SET NAMES utf8mb4");
            $Connex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $Connex;
        } catch (PDOException $e) {
            echo 'Conexión fallida: '.$e->getMessage();
        }
    }

    public function getDBA() {
        try {
            $Connex = new PDO($this->db_drive.":host=".$this->db_host.";port=".$this->db_port,$this->db_user, $this->db_pass);
            $Connex->exec("SET NAMES utf8mb4");
            $Connex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $Connex;
        } catch (PDOException $e) {
            echo 'Conexión fallida: '.$e->getMessage();
        }
    }
}
