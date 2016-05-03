<?php

use Oslo\Core as Core;

class UserModel extends Core\Model {

    public function test() {
        $q = new \Oslo\Database\Query();
        $q->prepare("SELECT * FROM Category");
        $this->db->read($q);
        return $q->getResult();
    }

}