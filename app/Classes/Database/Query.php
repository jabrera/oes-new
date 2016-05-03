<?php

namespace Oslo\Database;

class Query {

    private $query;
    private $result;

    public function __construct() {
        $this->query = "";
    }

    public function prepare($query) {
        $this->query = $query;
        return $this;
    }

    public function parameters($parameters) {
        for($i = 0; $i < sizeof($parameters); $i++) {
            $loadTo = "?";
            $param = strpos($this->query, $loadTo);
            if($param !== false)
                $this->query = substr_replace($this->query, "'".$parameters[$i]."'  ", $param, strlen($loadTo));
        }
        return $this;
    }

    public function setResult($result) {
        $this->result = $result;
    }

    public function getResult() {
        return $this->result;
    }

    public function get() {
        return $this->query;
    }

    public function dump() {
        echo $this->query;
    }

}