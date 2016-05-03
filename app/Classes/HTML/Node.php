<?php

namespace Oslo\HTML;

class Node {

    public static $selfClosingTags = array("area", "base", "br", "col", "command", "embed", "hr", "img", "input", "keygen", "link", "meta", "param", "source", "track", "wbr");

    public static function create($code) {
        $el = new Element($code);
        echo $el->render();
    }

}
