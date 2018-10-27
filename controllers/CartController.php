<?php

namespace app\controllers;

use app\models\repositories\CartRepository;

class CartController extends Controllers
{
	public function actionIndex()
	{
		$cart = (new CartRepository())->getAll();
		$cost = (new CartRepository())->getCartCost(1);
		echo $this->render("cart", ['cart' => $cart, 'cost' => $cost]);
	}
}
