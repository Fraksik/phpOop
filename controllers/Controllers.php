<?php

namespace app\controllers;


abstract class Controllers
{
	protected $action;
	protected $defaultAction = 'index';
	protected $layout = "main";
	protected $useLayout = true;

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
		ob_start();
		extract($params);
		include TEMPLATES_DIR . $template . ".php";
		return ob_get_clean();
	}
}