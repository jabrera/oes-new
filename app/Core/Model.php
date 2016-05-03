<?php

namespace Oslo\Core;

use Oslo\Database as DB;

class Model {

    public $db;

    function __construct() {
        if(DB_ENGINE == "mysql")
            $this->db = new DB\MySQL();
        elseif(DB_ENGINE == "sqlsrv")
            $this->db = new DB\SQLSRV();
        $this->db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }

}