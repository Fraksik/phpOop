<?php

namespace app\controllers;

use app\base\App;
use app\models\repositories\CartSession;
use app\models\repositories\ProductRepository;
use app\services\renderers\IRenderer;

class ProductController extends Controllers
{
	private $request;
	private $session;
	private $cartSession;
	private $productRepository;

	public function __construct(IRenderer $renderer, $useLayout = true)
	{
		parent::__construct($renderer, $useLayout);
		$this->request = App::call()->request;
		$this->session = App::call()->session;
		$this->productRepository = new ProductRepository();
		$this->cartSession = new CartSession();
	}

	public function actionIndex()
    {
    	$user = $this->session->get('user');
    	if (is_null($user)) {
		    $user = "незнакомец";
	    }
	    $msg = "Добро пожаловать, $user!";
	    $model = $this->productRepository->getAll();
	    echo $this->render("catalog", ['model' => $model, 'text' => $msg]);
    }

    public function actionCard()
    {
        $id = $this->request->get('id');
        $model = $this->productRepository->getOne($id);
        echo $this->render("card", ['model' => $model]);
    }

}