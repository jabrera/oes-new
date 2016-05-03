<?php

namespace Oslo\Security;

class UniqueIdentifier {
	
	public static function generate() {
		$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
		return substr(str_shuffle(str_repeat($chars, 8)), 0, 8);
	}

}