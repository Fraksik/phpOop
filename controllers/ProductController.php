<?php

namespace app\controllers;

use app\base\App;
use app\models\repositories\ProductRepository;
use app\services\renderers\IRenderer;

class ProductController extends Controllers
{
	private $request;
	private $productRepository;

	public function __construct(IRenderer $renderer, $useLayout = true)
	{
		parent::__construct($renderer, $useLayout);
		$this->request = App::call()->request;
		$this->productRepository = new ProductRepository();
	}

	public function actionIndex()
    {
	    $model = $this->productRepository->getAll();
	    echo $this->render("catalog", ['model' => $model]);
    }

    public function actionCard()
    {
        $id = $this->request->get('id');
        $model = $this->productRepository->getOne($id);
        echo $this->render("card", ['model' => $model]);
    }

}