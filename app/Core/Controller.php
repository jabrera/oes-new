<?php
/**
 * Copyright 2016 Juvar Abrera 
 *
 * // Apache
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * 	http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * // PHP Version 5
 *
 * This source file is subject to version 3.01 of the PHP license that 
 * is available through the world-wide-web at the following 
 * URI: http://www.php.net/license/3_01.txt.  If you did not receive 
 * a copy of the PHP License and are unable to obtain it through the 
 * web, please send a note to license@php.net so we can mail you 
 * a copy immediately.
 *
 * @project				Oslo Framework
 * @package				oslo-framework
 * @file				Controller.php
 * @author				Juvar Abrera <me@juvarabrera.com>
 * @copyright			2016 Juvar Abrera
 * @lastModified		5/6/16 11:15 AM
 */

namespace Oslo\Core;

use Oslo\Security As Security;

/**
 * Class Controller
 *
 * @package Oslo\Core
 */
class Controller {

	/**
	 * Holds the controller to load
	 *
	 * @var string
	 */
	protected $_controller;

	/**
	 * Holds the action to execute
	 *
	 * @var string
	 */
	protected $_action;

	/**
	 * Holds View object to render page
	 * @var View
	 */
	protected $_view;

	/**
	 * Controller constructor.
	 *
	 * @param string $controller
	 * @param string $action
	 */
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

	/**
	 * Checks if user should be logged in to view the page.
	 * If $should is TRUE and user is not logged in, redirect
	 * to $else_direct_to
	 *
	 * @param bool $should
	 * @param string $else_direct_to
	 */
	protected function shouldBeLoggedIn($should, $else_direct_to) {
		if(($should && !$this->_view->_session->loggedIn) || (!$should && $this->_view->_session->loggedIn))
			header("Location: $else_direct_to");
	}

	/**
	 * Sets data to be loaded to page
	 *
	 * @param string $name
	 * @param string $value
	 */
	public function set($name, $value) {
		$this->_view->set($name, $value);
	}

	/**
	 * Sets data in array to be loaded to page
	 *
	 * @param $array
	 */
	public function setArray($array) {
		foreach($array as $key => $value)
			$this->_view->set($key, $value);
	}

	/**
	 * Uses no layout
	 */
	protected function cleanLayout() {
		$this->_view->cleanLayout();
	}

    /**
     * Check if a page should be accessed
     * directly or not
     */
    protected function checkDirectAccess() {
        if($this->_view->get("_direct") === false)
            header("Location: ".ABSOLUTE_ROOT);
    }

	/**
	 * Render the page after Controller is loaded
	 */
	public function __destruct() {
		$this->_view->render();
	}

}