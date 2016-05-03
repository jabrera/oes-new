<?php

namespace Oslo\Interfaces;

interface IDatabase {

    public function connect($host, $user, $pass, $database);

    public function read(Query $query);

    public function execute(Query $query);

    public function free_resources($q);

    public function disconnect();

}