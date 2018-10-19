<?php

namespace app\controllers;


abstract class ControllersModel
{

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