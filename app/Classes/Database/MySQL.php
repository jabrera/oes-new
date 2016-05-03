<?php

namespace Oslo\Database;

class MySQL implements Oslo\Interfaces\IDatabase {

    protected $link;

    public function connect($host, $user, $pass, $database) {
        $this->link = mysql_connect($host, $user, $pass);
        mysql_select_db($database);
    }

    public function read(Query $query, $singleRow = false) {
        $q = mysql_query($query->get());
        $result = array();
        $columns = array();
        $numColumn = mysql_num_fields($q);
        for($i = 0; $i < $numColumn; $i++)
            $columns[] = mysql_field_name($q, $i);
        while($row = mysql_fetch_array($q)) {
            $tmp = array();
            foreach($columns as $column)
                $tmp[$column] = $row[$column];
            if($singleRow) {
                $result = $tmp;
                break;
            }
            $result[] = $tmp;
        }
        $query->setResult($result);
        return $query;
    }

    public function execute(Query $query) {
        $query->setResult(mysql_query($query->get()));
        return $query;
    }

    public function free_resources($q)
    {

    }

    public function disconnect() {
        mysql_close($this->link);
    }

}