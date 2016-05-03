<?php

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