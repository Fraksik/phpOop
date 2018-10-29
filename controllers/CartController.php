<?php

namespace app\controllers;

use app\base\App;
use app\models\Cart;
use app\models\repositories\CartRepository;
use app\services\renderers\IRenderer;

class CartController extends Controllers
{
	private $request;
	private $cartRepository;

	public function __construct(IRenderer $renderer, $useLayout = true)
	{
		parent::__construct($renderer, $useLayout);
		$this->request = App::call()->request;
		$this->cartRepository = new CartRepository();
	}

	public function actionIndex()
	{
		$cart = $this->cartRepository->getAll();
		$cost = $this->cartRepository->getCartCost(1);
		echo $this->render("cart", ['cart' => $cart, 'cost' => $cost]);
	}

	public function actionAdd() {
		$id = $this->request->post('id');
		(new CartRepository())->save(new Cart($id));
		echo json_encode(['success' => 'ok']);
	}

	public function actionDelete()
	{
		$id = $this->request->post('cart_id');
		$cart = $this->cartRepository->getOne($id);
		$this->cartRepository->delete($cart);
		echo json_encode(['success' => 'ok']);
	}

	public function actionDrop()
	{
		echo json_encode(['success' => 'ok']);
		$this->cartRepository->deleteAll();
	}
}
