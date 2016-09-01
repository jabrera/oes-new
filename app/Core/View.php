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
 * @file				View.php
 * @author				Juvar Abrera <me@juvarabrera.com>
 * @copyright			2016 Juvar Abrera
 * @lastModified		5/6/16 11:21 AM
 */

namespace Oslo\Core;

use Oslo\Helpers\Utility;

/**
 * Class View
 *
 * @package Oslo\Core
 */
class View {

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
	 * Holds the data to be loaded to page
	 *
	 * @var array(string)
	 */
	protected $_data = array();

	/**
	 * @var Oslo\Security
	 */
	public $_session;

	/**
	 * Holds the directory of the components to laod to page
	 * @var array
	 */
	public $_cdir = array();

	/**
	 * Layout to use when loading the page
	 * @var string
	 */
	public $_layout = DEFAULT_LAYOUT;

	/**
	 * View constructor.
	 *
	 * @param string $controller
	 * @param string $action
	 */
	public function __construct($controller, $action) {
        $this->_controller = $controller;
        $this->_action = $action;
        $this->_data["PageTitle"] = PAGETITLE;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function get($name) {
        if(isset($this->_data[$name]))
            return $this->_data[$name];
        return false;
    }

	/**
	 * Sets data to be loaded to page
	 *
	 * @param string $name
	 * @param string $value
	 */
	public function set($name, $value) {
        $this->_data[$name] = $value;
    }

	/**
	 * Sets data in array to be loaded to page
	 *
	 * @param $array
	 */
	public function setArray($array) {
        foreach($array as $key => $value)
            $this->set($key, $value);
    }

	/**
	 * Uses no layout
	 */
	public function cleanLayout() {
        $this->_layout = "";
    }

	/**
	 * Initialize component directory to load depending on user type.
	 *
	 * @param string $userType
	 *
	 */
	private function setDefaultComponentDirectory($userType) {
        $this->_cdir = array(
            "action-bar" => ROOT.DS."app".DS."Views".DS."shared".DS.$userType.DS."action-bar.phtml",
            "slider" => ROOT.DS."app".DS."Views".DS."shared".DS.$userType.DS."slider.phtml",
        );
    }

	/**
	 * Sets slider menu options depending on user type
	 *
	 * @param string $userType
	 */
	private function getSliderMenu($userType) {
        if($userType == "guest") {
            $this->_data["slider_menu"] = array(
                array(
                    "link" => array(
                        array(
                            "link" => "#",
                            "text" => "hello"
                        ),
                        array(
                            "link" => "#",
                            "text" => "hello"
                        )
                    ),
                    "icon" => "face",
                    "text" => "Hello"
                )
            );
        }
    }

	/**
	 * Render page
	 */
	public function render() {
        $userType = $this->_session->checkUserType();
        $this->setDefaultComponentDirectory($userType);
        $this->getSliderMenu($userType);
        extract($this->_data);
        if(file_exists(ROOT.DS.'app'.DS.'Views'.DS.$this->_controller.DS.$this->_action.".phtml")) {
            ob_start();
            require_once(ROOT.DS.'app'.DS.'Views'.DS.$this->_controller.DS.$this->_action.".phtml");
            $__BODY__ = ob_get_contents();
            ob_end_clean();
            $__BODY__ = Utility::removeTabs($__BODY__);
            if($this->_layout != "") {
                ob_start();
                require_once(ROOT.DS.'app'.DS.'Views'.DS."shared".DS."_layout.phtml");
                $__LAYOUT__ = ob_get_contents();
                ob_end_clean();
                $__LAYOUT__ = Utility::removeTabs($__LAYOUT__);
                echo $__LAYOUT__;
            } else
                echo $__BODY__;
        } else
            require_once(ROOT.DS.'app'.DS.'Views'.DS."shared".DS."error.phtml");
    }
}