<?php

namespace app\services;

class Autoloader
{

	public function loadClass($className)
	{

		$className = str_replace(['app', '\\'], [$_SERVER["DOCUMENT_ROOT"], DIRECTORY_SEPARATOR], $className) .
			".php";

		if (file_exists($className)) {
			include $className;
		}
	}
}