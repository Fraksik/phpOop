<?php

namespace app\controllers;

use app\models\Cart;
use app\models\repositories\CartRepository;
use app\models\repositories\ProductRepository;
use app\services\Request;

class ProductController extends Controllers
{

    public function actionIndex()
    {
	    $model = (new ProductRepository())->getAll();
	    echo $this->render("catalog", ['model' => $model]);
    }

    public function actionCard()
    {
        $id = (new Request())->get('id');
        $model = (new ProductRepository())->getOne($id);
        echo $this->render("card", ['model' => $model]);
    }

    public function actionAdd() {
	    $id = (new Request())->get('id');
	    $price = (new ProductRepository())->getPrice($id);
	    (new CartRepository())->save(new Cart($id, $price));

	    header("Location: /product");
    }

}