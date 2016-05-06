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
 * @file				Query.php
 * @author				Juvar Abrera <me@juvarabrera.com>
 * @copyright			2016 Juvar Abrera
 * @lastModified		5/6/16 11:37 AM
 */

namespace Oslo\Database;

/**
 * Class Query
 *
 * @package Oslo\Database
 */
class Query {

	/**
	 * Raw string of the query
	 *
	 * @var string
	 */
	private $query;
	/**
	 * Array of rows of the result of the query
	 *
	 * @var array()
	 */
	private $result;

	/**
	 * Sets $query to empty string
	 * Query constructor.
	 */
	public function __construct() {
        $this->query = "";
    }

	/**
	 * Prepares the query in raw string
	 *
	 * @param $query
	 *
	 * @return $this
	 */
	public function prepare($query) {
        $this->query = $query;
        return $this;
    }

	/**
	 * Replaces '?' inside the raw query
	 * @param array $parameters
	 *
	 * @return instance
	 */
	public function parameters($parameters) {
        for($i = 0; $i < sizeof($parameters); $i++) {
            $loadTo = "?";
            $param = strpos($this->query, $loadTo);
            if($param !== false)
                $this->query = substr_replace($this->query, "'".$parameters[$i]."'  ", $param, strlen($loadTo));
        }
        return $this;
    }

	/**
	 * Sets the array of data to $result
	 * @param $result
	 */
	public function setResult($result) {
        $this->result = $result;
    }

	/**
	 * @return $result array
	 */
	public function getResult() {
        return $this->result;
    }

	/**
	 * Gets the raw query in string
	 *
	 * @return string
	 */
	public function get() {
        return $this->query;
    }

	/**
	 * Prints the raw query
	 */
	public function dump() {
        echo $this->query;
    }

}