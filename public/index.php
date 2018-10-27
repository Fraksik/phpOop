<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/../vendor/autoload.php";

use app\services\renderers\TemplateRenderer;

$request = new \app\services\Request();

$controllerClass = $request->getControllerClass();
$actionName = $request->getActionName();

$controller = new $controllerClass(new TemplateRenderer());
$controller->run($actionName);
