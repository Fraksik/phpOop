<?php

namespace app\controllers;

use app\models\Cart;
use app\services\renderers\IRenderer;

class CartController extends Controllers
{
	private $userId;

	public function __construct(IRenderer $renderer, $useLayout = true)
	{
		parent::__construct($renderer, $useLayout);
		$this->userId = $this->session->get('userId');
	}

	public function actionIndex()
	{
		if (!is_null($this->userId)) {
			$cart = $this->cartDb->getAllByUser($this->userId);
			$cost = $this->cartDb->getCartCost($this->userId);
		} else {
			$cart = $this->cartSes->getAll();
			$cost = $this->cartDb->getCartCost();
		}
		echo $this->render("cart", ['cart' => $cart, 'cost' => $cost]);
	}

	public function actionAdd() {
		$productId = $this->request->post('id');

		if (!is_null($this->userId)) {
			$this->cartDb->save(new Cart($productId, $this->userId));
		} else {
			$this->cartSes->add($productId);
		}
		echo json_encode(['success' => 'ok']);
	}

	public function actionDelete()
	{
		$id = $this->request->post('cart_id');
		$productId = $this->request->post('id');

		if (!is_null($this->userId)) {
			$cart = $this->cartDb->getOne($id);
			$this->cartDb->deleteProduct($cart);
		} else {
			$this->cartSes->delete($productId);
		}

		echo json_encode(['success' => 'ok']);
	}

	public function actionDrop()
	{
		if (!is_null($this->userId)) {
			$this->cartDb->deleteAll($this->userId);
		} else {
			$this->cartSes->deleteAll();
		}

		echo json_encode(['success' => 'ok']);

	}

}
