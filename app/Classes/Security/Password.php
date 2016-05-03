<?php

namespace Oslo\Security;

class Password {

    private static $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_=+{[;:'\"\\<>?/,.]} ";

    public static function hash($password) {
        $hashed = "";
        $password = str_split($password);
        for($i = 0; $i < sizeof($password); $i++) {
            $char = $password[$i];
            $pos = strpos(self::$chars, $char);
            $len = 1;
            if($i % 2 == 0)
                $len = 2;
            $hashed .= self::getChar($pos, sizeof($password)*$len, $len);
        }
        $hashed = strrev($hashed);
        return "$.".$hashed;
    }

    private static function getChar($start, $end, $len) {
        $step = $start + $end;
        if($step > strlen(self::$chars))
            $step -= strlen(self::$chars);
        return substr(self::$chars, $step, $len);
    }

}