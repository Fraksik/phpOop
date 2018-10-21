<?php

namespace app\services\renderers;


class TwigRenderer implements IRenderer
{

	private $twig;

	public function __construct(\Twig_Environment $twig)
	{
		$this->twig = $twig;
	}

	public function render($template, $params = [])
	{
		$template .= ".twig";

		return $this->twig->render($template, $params);
	}
}
