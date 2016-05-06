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
 * @file				Element.php
 * @author				Juvar Abrera <me@juvarabrera.com>
 * @copyright			2016 Juvar Abrera
 * @lastModified		5/6/16 8:13 AM
 */

namespace Oslo\HTML;

class Element {
    private $code, $tag, $attr, $text;
	
    public function __construct($code) {
        $this->code = $code;
        $this->tag = "div";
        $this->attr = array();
        $this->text = "";
        $this->getTag()
            ->getAttributes()
            ->getClass()
            ->getText()
            ->getID();
    }

    private function getText() {
        if(preg_match("/(?<={)(.*?)(?=})/", $this->code, $result))
            $this->text = $result[0];
        return $this;
    }

    private function getAttributes() {
        if(preg_match_all("/(?<=\[)(.*?)(?=\])/", $this->code, $result))
            foreach($result[0] as $r) {
                $temp_attr = explode("=", $r);
                $this->attr[$temp_attr[0]] = $temp_attr[1];
            }
        return $this;
    }

    private function getID() {
        if(preg_match("/(?<=#)[a-zA-Z0-1-_]+/", $this->code, $result))
            $this->attr["id"] = $result[0];
        return $this;
    }

    private function getClass() {
        if(preg_match("/(?<=\.)[a-zA-Z0-1-_]+/", $this->code, $result))
            $this->attr["class"] = $result[0];
        return $this;
    }

    private function getTag() {
        if(preg_match("/^(?!\.|#|\[|{)\w+/", $this->code, $result))
            $this->tag = $result[0];
        return $this;
    }

    public function render() {
        $html = "<".$this->tag;
        foreach($this->attr as $attr => $value)
            $html .= " ".$attr."=\"".$value."\"";
        if(!in_array($this->tag, Node::$selfClosingTags))
            $html .= ">".$this->text."</".$this->tag.">";
        else
            $html .= ">";
        return $html;
    }
}