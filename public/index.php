<?php
include $_SERVER['DOCUMENT_ROOT'] ."/config/main.php";
include ROOT_DIR . "/services/Autoloader.php";

spl_autoload_register([new app\services\Autoloader(), 'loadClass']);

$controllerName = isset($_GET['c']) ? $_GET['c'] : DEFAULT_CONTROLLER;
$actionName = isset($_GET['a']) ? $_GET['a'] : null;

$controllerClass = CONTROLLERS_NAMESPACE . "\\" . ucfirst($controllerName) . "Controller";

if(class_exists($controllerClass)){
	$controller = new $controllerClass;
	$controller->run($actionName);
}

