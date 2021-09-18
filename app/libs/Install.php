<?php

include_once(__DIR__.'/index.php');

/**
 * Clase Básica para Chequear si Ya se instaló rekutuPHP
 */

class Install
{

	private $db_host;
    private $db_port;
    private $db_root;
    private $db_poot;
    private $db_drive;

	public function __construct()
	{
		$this->db_host  = DB_SERVER;
        $this->db_port  = DB_PORT;
        $this->db_root  = DB_ROOT;
        $this->db_poot  = DB_ROOTPASSWD;
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

	public function chkDB()
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

	public function chkInstall()
	{
		return $this->chkDB();
	}

	public function __destruct(){}
}

