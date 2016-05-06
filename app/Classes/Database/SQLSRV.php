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
 * @file				SQLSRV.php
 * @author				Juvar Abrera <me@juvarabrera.com>
 * @copyright			2016 Juvar Abrera
 * @lastModified		5/6/16 11:06 AM
 */

namespace Oslo\Database;

/**
 * Uses sqlsrv functions for websites that uses SQL Server.
 * Uses Interface IDatabase. See interface for function documentation.
 *
 * Class SQLSRV
 *
 * @package Oslo\Database
 *
 */
class SQLSRV implements Oslo\Interfaces\IDatabase {

	/**
	 * Instance of the connection of the database
	 *
	 * @var MySQL Link Identifier
	 */
    protected $link;

    public function connect($host, $user, $pass, $database) {
        $connectionInfo = array(
            "UID" => $user,
            "pwd" => $pass,
            "Database" => $database,
            "LoginTimeout" => 30,
            "Encrypt" => 1,
            "ReturnDatesAsStrings" => true
        );
        $this->link = sqlsrv_connect($host, $connectionInfo);
    }

    public function read(Query $query, $singleRow = false) {
        $q = sqlsrv_query($this->link, $query->get());
        $result = array();
        while($row = sqlsrv_fetch_array($q, SQLSRV_FETCH_ASSOC)) {
            if($singleRow) {
                $result = $row;
                break;
            }
            $result[] = $row;
        }
        $query->setResult($result);
        return $query;
    }

    public function execute(Query $query) {
        $query->setResult(sqlsrv_query($this->link, $query->get()));
        return $query;
    }

    public function free_resources($q) {
        sqlsrv_free_stmt($q);
    }

    public function disconnect() {
        sqlsrv_close($this->link);
    }

}