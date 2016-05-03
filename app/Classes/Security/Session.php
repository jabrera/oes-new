<?php

namespace Oslo\Security;
    
class Session {

    private $ID = "";
    public $loggedIn = false;

    public function __constuct() {
        session_start();
    }

    public function setUser($id) {
        $this->ID = $id;
    }

    public function getUser() {
        return $this->ID;
    }

    public function checkSession() {
        if(isset($_SESSION['OSLO_loggedID'])) {
            $this->loggedIn = true;
            $this->ID = $_SERVER['OSLO_loggedID'];
            //check if user exists else logout
        }
    }

    public function checkUserType() {
        return ($this->loggedIn) ? "user" : "guest";
    }

}

