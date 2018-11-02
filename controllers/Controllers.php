<?php

namespace app\controllers;


use app\base\App;
use app\models\repositories\session\CartSession;
use app\models\repositories\session\UserSession;
use app\services\renderers\IRenderer;

abstract class Controllers
{
	protected $action;
	protected $request;
	protected $session;
	protected $defaultAction = 'index';
	protected $layout = "main";
	protected $useLayout;
	protected $productDb;
	protected $userDb;
	protected $ordersDb;
	protected $cartDb;
	protected $userSes;
	protected $cartSes;
	private $renderer = null;

	public function __construct(IRenderer $renderer, $useLayout = true)
	{
		$this->renderer = $renderer;
		$this->useLayout = $useLayout;
		$this->request = App::call()->request;
		$this->session = App::call()->session;
		$this->productDb = App::call()->productDb;
		$this->userDb = App::call()->userDb;
		$this->cartDb = App::call()->cartDb;
		$this->ordersDb = App::call()->ordersDb;
		$this->userSes = new UserSession();
		$this->cartSes = new CartSession();
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