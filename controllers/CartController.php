<?php

namespace app\controllers;


use app\models\Cart;

class CartController extends ControllersModel
{
	protected $action;
	protected $defaultAction = 'index';
	protected $layout = "main";
	protected $useLayout = true;

	public function run($action = null)
	{
		$this->action = $action ?: $this->defaultAction;
		$method = "action" . ucfirst($this->action);
		if(method_exists($this, $method)){
			$this->$method();
		}else{
			echo "404";
		}

	}

	public function actionIndex()
	{
		$cart = Cart::getAll();
		$cost = Cart::getCartCost(1);
		echo $this->render("cart", ['cart' => $cart, 'cost' => $cost]);
	}


}
