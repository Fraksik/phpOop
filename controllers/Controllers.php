<?php

namespace app\controllers;


use app\base\App;
use app\services\renderers\IRenderer;

abstract class Controllers
{
	protected $action;
	protected $request;
	protected $session;
	protected $defaultAction = 'index';
	protected $layout = "main";
	protected $useLayout;
	protected $repository;
	private $renderer = null;

	public function __construct(IRenderer $renderer, $useLayout = true)
	{
		$this->renderer = $renderer;
		$this->useLayout = $useLayout;
		$this->request = App::call()->request;
		$this->session = App::call()->session;
		$this->repository = $this->getRepository();
	}

	public function run($action = null)
	{
		$this->action = $action ?: $this->defaultAction;
		$method = "action" . ucfirst($this->action);
		if(method_exists($this, $method)){
			$this->$method();
		}else{
			echo "404";
		}
	}

	abstract public function getRepository();

	protected function render($template, $params = [])
	{
		if($this->useLayout){
			$content = $this->renderTemplate($template, $params);
			return $this->renderTemplate("layouts/{$this->layout}", ['content' => $content]);
		}
		return $this->renderTemplate($template, $params);
	}

	protected function renderTemplate($template, $params = [])
	{
		return $this->renderer->render($template, $params);
	}
}