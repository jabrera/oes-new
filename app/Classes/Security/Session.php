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
 * @file				Session.php
 * @author				Juvar Abrera <me@juvarabrera.com>
 * @copyright			2016 Juvar Abrera
 * @lastModified		5/6/16 11:05 AM
 */

namespace Oslo\Security;

use Oslo\Interfaces as Interfaces;

/**
 * Class Session
 *
 * @package Oslo\Security
 */
class Session implements Interfaces\ISession {

	/**
	 * Holds ID of the logged user.
	 * 
	 * @var string
	 *
	 */
	private $ID = "";

	/**
	 * Bool if user is logged in or not.
	 *
	 * @var bool
	 */
	public $loggedIn = false;

	/**
	 * Starts the session
	 */
	public function __constuct() {
        session_start();
    }

	/**
	 * Sets the logged user with $id
	 *
	 * @param $id
	 *
	 */
	public function setUser($id) {
        $this->ID = $id;
    }

	/**
	 * Gets the logged user
	 *
	 * @return string
	 *
	 */
	public function getUser() {
        return $this->ID;
    }

	/**
	 * Checks if user is logged in or not
	 */
	public function checkSession() {
        if(isset($_SESSION[SESSION_PREFIX.'loggedID'])) {
            $this->loggedIn = true;
            $this->ID = $_SERVER[SESSION_PREFIX.'loggedID'];
            //check if user exists else logout
        }
    }

	/**
	 * Gets the user type of the user. If user is logged,
	 * user type is retrieve from the Account table in
	 * the database on the Type column
	 *
	 * @return string
	 *
	 */
	public function checkUserType() {
        return ($this->loggedIn) ?  : "guest";
    }

}

