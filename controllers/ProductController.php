<?php

namespace app\controllers;

use app\models\repositories\ProductRepository;

class ProductController extends Controllers
{

    public function actionIndex()
    {
	    $model = (new ProductRepository())->getAll();
	    echo $this->render("catalog", ['model' => $model]);
    }

    public function actionCard()
    {
        $id = $_GET['id'];
        $model = (new ProductRepository())->getOne($id);
        echo $this->render("card", ['model' => $model]);
    }

}