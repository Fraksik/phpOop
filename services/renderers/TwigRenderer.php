<?php

namespace app\services\renderers;

class TwigRenderer implements IRenderer
{

	private $twig;

	public function __construct()
	{
		$this->twig = new \Twig_Environment(new \Twig_Loader_Filesystem(TWIG_TEMPLATES_DIR));
	}

	public function render($template, $params = [])
	{
		$template .= ".twig";

		return $this->twig->render($template, $params);
	}
}
