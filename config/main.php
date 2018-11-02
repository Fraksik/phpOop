<?php
return [
	'rootDir' => __DIR__ . "/../",
	'templatesDir' => __DIR__ . "/../views/",
	'defaultController' => 'product',
	'controllerNamespace' => "app\\controllers",
	'components' => [
		'db' => [
			'class' => \app\services\Db::class,
			'driver' => 'mysql',
			'host' => 'phpOop',
			'login' => 'php',
			'password' => '',
			'database' => 'phpOop',
			'charset' => 'utf8'
		],
		'request' => [
			'class' => \app\services\Request::class
		],
		'renderer' => [
			'class' => \app\services\renderers\TemplateRenderer::class
		],
		'session' => [
			'class' => \app\services\Session::class
		],
		'cartDb' => [
			'class' => \app\models\repositories\CartRepository::class
		],
		'ordersDb' => [
			'class' => \app\models\repositories\OrdersRepository::class
		],
		'productDb' => [
			'class' => \app\models\repositories\ProductRepository::class
		],
		'userDb' => [
			'class' => \app\models\repositories\UserRepository::class
		],
		'regTst' => [
			'class' => \app\services\RegTst::class
		]
	]

];