<?php

namespace Oslo\Database;

class SQLSRV implements Oslo\Interfaces\IDatabase {

    protected $link;

    public function connect($host, $user, $pass, $database) {
        $connectionInfo = array(
            "UID" => $user,
            "pwd" => $pass,
            "Database" => $database,
            "LoginTimeout" => 30,
            "Encrypt" => 1,
            "ReturnDatesAsStrings" => true
        );
        $this->link = sqlsrv_connect($host, $connectionInfo);
    }

    public function read(Query $query, $singleRow = false) {
        $q = sqlsrv_query($this->link, $query->get());
        $result = array();
        while($row = sqlsrv_fetch_array($q, SQLSRV_FETCH_ASSOC)) {
            if($singleRow) {
                $result = $row;
                break;
            }
            $result[] = $row;
        }
        $query->setResult($result);
        return $query;
    }

    public function execute(Query $query) {
        $query->setResult(sqlsrv_query($this->link, $query->get()));
        return $query;
    }

    public function free_resources($q) {
        sqlsrv_free_stmt($q);
    }

    public function disconnect() {
        sqlsrv_close($this->link);
    }

}