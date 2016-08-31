<?php

use Oslo\Core as Core;

class OController extends Core\Controller {

	public function __construct($controller, $action) {
		parent::__construct($controller, $action);
	}

	public function index() {
		
	}

	public function test() {
	    $this->checkDirectAccess();
		$this->shouldBeLoggedIn(false, ROOT.DS);
		$this->cleanLayout();
//        if(isset($_POST['direct']))
//            echo 'a';
	}
}