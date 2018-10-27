<?php

namespace app\services;

class Request
{
	private $requestString;
	private $controllerName;
	private $actionName;
	private $params;


	public function __construct()
	{
		$this->requestString = $_SERVER['REQUEST_URI'];
		$this->parseRequest();
	}

	public function parseRequest()
	{
		$pattern = "#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<params>.*)#ui";
		if(preg_match_all($pattern, $this->requestString, $matches)){
			$this->controllerName = $matches['controller'][0];
			$this->actionName = $matches['action'][0];
			$this->params['get'] = $_GET;
			$this->params['post'] = $_POST;

		} else {
			$this->controllerName = DEFAULT_CONTROLLER;
			$this->actionName = null;
		}
	}

	public function getControllerClass()
	{
		$controllerClass = CONTROLLERS_NAMESPACE . "\\" . ucfirst($this->controllerName) . "Controller";
		if (class_exists($controllerClass)) {
			return $controllerClass;
		} else {
			return CONTROLLERS_NAMESPACE . "\\" . ucfirst(DEFAULT_CONTROLLER) . "Controller";
		}

	}

	public function getActionName()
	{
		return $this->actionName;
	}

	public function getParams()
	{
		return $this->params;
	}

	public function get($name)
	{
		if(isset($this->params['get'][$name])){
			return $this->params['get'][$name];
		}
		return null;
	}

	public function post($name)
	{
		if(isset($this->params['post'][$name])){
			return $this->params['post'][$name];
		}
		return null;
	}
}