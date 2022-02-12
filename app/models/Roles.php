<?php

include_once(CORE_PATH.'/index.php');

class RolesModel extends Model {

    public function __construct(){
        parent::__construct();
    }

    public function getRoles() {
        $data = $this->dbSelect('*','users','id != 1');
        return $data;
    }

}
