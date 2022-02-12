<?php

include_once(CORE_PATH.'/index.php');

class UsersModel extends Model {

    public function __construct(){
        parent::__construct();
    }

    public function getUsers() {
        $data = $this->dbSelect('*','users','id != 1');
        return $data;
    }

}
