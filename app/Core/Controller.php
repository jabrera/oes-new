<?php

namespace Oslo\Core;

use Oslo\Security As Security;

class Controller {

	protected $_controller;
	protected $_action;
	protected $_view;

	public function __construct($controller, $action) {
		$this->_controller = $controller;
		$this->_action = $action;
		$this->_view = new View($controller, $action);

		if(isset($_GET['_cl']) || isset($_POST['_cl']))
			$this->cleanLayout();

		$this->setArray($_GET);
		$this->setArray($_POST);

		$_session = new Security\Session();
		$_session->checkSession();
		$this->_view->_session = $_session;
	}

	protected function shouldBeLoggedIn($should, $else_direct_to) {
		if(($should && !$this->_view->_session->loggedIn) || (!$should && $this->_view->_session->loggedIn))
			header("Location: $else_direct_to");
	}

	public function set($name, $value) {
		$this->_view->set($name, $value);
	}

	public function setArray($array) {
		foreach($array as $key => $value)
			$this->_view->set($key, $value);
	}

	protected function cleanLayout() {
		$this->_view->cleanLayout();
	}

	public function __destruct() {
		$this->_view->render();
	}

}