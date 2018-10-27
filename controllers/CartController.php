<?php

namespace app\controllers;

use app\models\repositories\CartRepository;
use app\services\Request;

class CartController extends Controllers
{
	public function actionIndex()
	{
		$cart = (new CartRepository())->getAll();
		$cost = (new CartRepository())->getCartCost(1);
		echo $this->render("cart", ['cart' => $cart, 'cost' => $cost]);
	}

	public function actionDelete()
	{
		$id = (new Request())->get('id');
		$cart = (new CartRepository())->getOne($id);
		(new CartRepository())->delete($cart);

		header("Location: /cart");
	}

	public function actionDeleteAll()
	{
		$drop = (new Request())->post('drop_basket');
		$order = (new Request())->post('order');
		$userId = (new Request())->post('userId');
		if (isset($drop)) {
			(new CartRepository())->deleteAll($userId);
			header("Location: /cart");
		}
	}
}
