<?php

namespace app\controllers;

use app\models\repositories\ProductRepository;
use app\services\renderers\IRenderer;

class ProductController extends Controllers
{
//	private $productRepository;

	public function __construct(IRenderer $renderer, $useLayout = true)
	{
		parent::__construct($renderer, $useLayout);
//		$this->productRepository = new ProductRepository();
	}

	public function getRepository()
	{
		return new ProductRepository();
	}

	public function actionIndex()
    {
    	$user = $this->session->get('user');
    	if (is_null($user)) {
		    $user = "незнакомец";
	    }
	    $msg = "Добро пожаловать, $user!";
	    $model = $this->repository->getAll();
	    echo $this->render("catalog", ['model' => $model, 'text' => $msg]);
    }

    public function actionCard()
    {
        $id = $this->request->get('id');
        $model = $this->repository->getOne($id);
        echo $this->render("card", ['model' => $model]);
    }

}