<?php

namespace app\base;

use app\traits\TSingleton;

class App
{
	use TSingleton;

	public static function call()
	{
		return static::getInstance();
	}

	public $config;

	private $components;

	public function run($config)
	{
		$this->config = $config;
		$this->components = new Storage();
		$this->runController();
	}

	private function runController()
	{
		$controllerName = $this->request->getControllerName() ?? $this->config['defaultController'];
		$actionName = $this->request->getActionName();
		$controllerClass = $this->config['controllerNamespace'] . "\\" . ucfirst($controllerName) . "Controller";

		if (class_exists($controllerClass)) {
			$controller = new $controllerClass(
				new \app\services\renderers\TemplateRenderer()
			);
			try {
				$controller->run($actionName);
			} catch (\Exception $e) {

			}
		} else {
			echo "404";
		}
	}

	public function createComponent($key)
	{
		if (isset($this->config['components'][$key])) {
			$params = $this->config['components'][$key];
			$class = $params['class'];
			if (class_exists($class)) {
				unset($params['class']);
				$reflection = new \ReflectionClass($class);
				return $reflection->newInstanceArgs($params);
			} else {
				throw new \Exception("Не определен класс компонентта!");
			}
		} else {
			throw new \Exception("Компонент {$key} не найден!");
		}
	}

	function __get($name)
	{
		return $this->components->get($name);
	}
}