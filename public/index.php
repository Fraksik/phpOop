<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

$controllerName = isset($_GET['c']) ? $_GET['c'] : DEFAULT_CONTROLLER;
$actionName = isset($_GET['a']) ? $_GET['a'] : null;

$controllerClass = CONTROLLERS_NAMESPACE . "\\" . ucfirst($controllerName) . "Controller";

if(class_exists($controllerClass)){
	$controller = new $controllerClass(new \app\services\renderers\TemplateRenderer);
	$controller->run($actionName);
}
