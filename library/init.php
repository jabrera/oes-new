<?php

require_once("library".DS."config.php");

function setReporting() {
	if(DEVELOPMENT_ENVIRONMENT == true) {
		error_reporting(E_ALL);
		ini_set("display_errors", "On");
	} else {
		error_reporting(E_ALL);
		ini_set("display_errors", "Off");
		ini_set("log_errors", "On");
		ini_set("error_log", ROOT.DS."tmp".DS."logs".DS."error.log");
	}
}

function stripSlashesDeep($value) {
	return is_array($value) ? array_map("stripSlashesDeep", $value) : stripslashes($value);
}

function removeQuotes() {
	if(get_magic_quotes_gpc()) {
		$_GET = stripSlashesDeep($_GET);
		$_POST = stripSlashesDeep($_POST);
		$_COOKIE = stripSlashesDeep($_COOKIE);
	}
}

function unregisterGlobals() {
	if(ini_get("register_globals")) {
		$array = array("_SESSION", "_POST", "_GET", "_COOKIE", "_REQUEST", "_SERVER", "_ENV", "_FILES");
		foreach($array as $value) {
			foreach($GLOBALS[$value] as $key => $var) {
				if($var === $GLOBALS[$key])
					unset($GLOBALS[$key]);
			}
		}
	}
}

function callHook() {
	global $url;

	$urlArray = explode("/", $url);
	$controller = DEFAULT_CONTROLLER;
	if(isset($urlArray[0]))
		if($urlArray[0] != "")
			$controller = $urlArray[0];
	array_shift($urlArray);
	$action = DEFAULT_ACTION;
	if(isset($urlArray[0]))
		if($urlArray[0] != "")
			$action = $urlArray[0];
	array_shift($urlArray);
	$data = $urlArray;
	$controller = strtolower($controller);
	$controllerName = $controller;
	$controller = checkShortcuts($controller);
	$controller = ucwords($controller);
	$model = rtrim($controller, "s");
	$controller .= "Controller";
    unset($_GET["url"]);
	if(class_exists($controller)) {
		$dispatch = new $controller($controllerName, $action);
		if((int)method_exists($controller, $action))
			call_user_func_array(array($dispatch,$action), $data);
	}
	else
		header("Location: ".ABSOLUTE_ROOT);
}

function checkShortcuts($original) {
	$shortcuts = require_once("library".DS."controller_shortcuts.php");
	if(isset($shortcuts[$original])) {
		return $shortcuts[$original];
	}
	return $original;
}

function loadJavascript($path) {
	$files = scandir($path);
	foreach($files as $file) {
		if (!($file == "." || $file == "..") && !is_dir($path.$file."/")) {
			echo '<script src="' . ABSOLUTE_ROOT . $path . $file . '"></script>';
		}
	}
}

function checkFolder($path, $class) {
	$files = scandir($path);
	foreach($files as $file) {
		if($file == "." || $file == "..") continue;
		if(is_dir($path.DS.$file)) {
			checkFolder($path.DS.$file, $class);
		} elseif(file_exists($path.DS.$class.".php")) {
			require_once($path.DS.$class.".php");
		}
	}
	return false;
}

function classLoader($class) {
	$class = ltrim($class, '\\');
	$fileName  = '';
	$namespace = '';
	if ($lastNsPos = strrpos($class, '\\')) {
		$namespace = substr($class, 0, $lastNsPos);
		$class = substr($class, $lastNsPos + 1);
		$fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
	}
	$folders = array("Classes", "Core", "Controllers", "Models");
	foreach($folders as $folder) {
		checkFolder(ROOT.DS."app".DS.$folder, $class);
	}
}

spl_autoload_register("classLoader");

setReporting();
removeQuotes();
unregisterGlobals();
callHook();