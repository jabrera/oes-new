<?php

namespace Oslo\Core;

class View {

    protected $_controller;
    protected $_action;
    protected $_data = array();
    public $_session;
    public $_cdir = array();
    public $_layout = "_layout";

    public function __construct($controller, $action) {
        $this->_controller = $controller;
        $this->_action = $action;
        $this->_data["PageTitle"] = "Oslo Framework";
    }

    public function set($name, $value) {
        $this->_data[$name] = $value;
    }

    public function setArray($array) {
        foreach($array as $key => $value)
            $this->set($key, $value);
    }

    public function cleanLayout() {
        $this->_layout = "";
    }

    public function removeTabs($str) {
        return trim(preg_replace("/\n| +/", " ", $str));
    }

    private function setDefaultComponentDirectory($userType) {
        $this->_cdir = array(
            "action-bar" => ROOT.DS."app".DS."Views".DS."shared".DS.$userType.DS."action-bar.phtml",
            "slider" => ROOT.DS."app".DS."Views".DS."shared".DS.$userType.DS."slider.phtml",
        );
    }

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
            $__BODY__ = $this->removeTabs($__BODY__);
            if($this->_layout != "") {
                ob_start();
                require_once(ROOT.DS.'app'.DS.'Views'.DS."shared".DS."_layout.phtml");
                $__LAYOUT__ = ob_get_contents();
                ob_end_clean();
                $__LAYOUT__ = $this->removeTabs($__LAYOUT__);
                echo $__LAYOUT__;
            } else
                echo $__BODY__;
        } else
            require_once(ROOT.DS.'app'.DS.'Views'.DS."shared".DS."error.phtml");
    }
}