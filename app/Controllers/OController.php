<?php

use Oslo\Core as Core;

class OController extends Core\Controller {

	public function __construct($controller, $action) {
		parent::__construct($controller, $action);
	}

	public function index() {
		
	}

	public function test() {
		$this->shouldBeLoggedIn(false, ROOT.DS);
		$this->cleanLayout();
	}
}