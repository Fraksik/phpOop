<?php

namespace app\controllers;


use app\models\Cart;

class CartController extends Controllers
{
	protected $layout = "main";

	public function actionIndex()
	{
		$cart = Cart::getAll();
		$cost = Cart::getCartCost(1);
		echo $this->render("cart", ['cart' => $cart, 'cost' => $cost]);
	}


}
