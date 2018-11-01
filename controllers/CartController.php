<?php

namespace app\controllers;

use app\models\Cart;
use app\models\repositories\CartRepository;
use app\models\repositories\session\CartSession;
use app\services\renderers\IRenderer;

class CartController extends Controllers
{
	private $userId;
	private $cartSession;


	public function __construct(IRenderer $renderer, $useLayout = true)
	{
		parent::__construct($renderer, $useLayout);
		$this->userId = $this->session->get('userId');
		$this->cartSession = new CartSession();
	}

	public function getRepository()
	{
		return new CartRepository();
	}

	public function actionIndex()
	{
		if (!is_null($this->userId)) {
			$cart = $this->repository->getAllByUser($this->userId);
			$cost = Cart::getCartCost($this->userId);
		} else {
			$cart = CartSession::getAll();
			$cost = Cart::getCartCost();
		}
		echo $this->render("cart", ['cart' => $cart, 'cost' => $cost]);
	}

	public function actionAdd() {
		$productId = $this->request->post('id');

		if (!is_null($this->userId)) {
			$this->repository->save(new Cart($productId, $this->userId));
		} else {
			$this->cartSession->add($productId);
		}
		echo json_encode(['success' => 'ok']);
	}

	public function actionDelete()
	{
		$id = $this->request->post('cart_id');
		$productId = $this->request->post('id');

		if (!is_null($this->userId)) {
			$cart = $this->repository->getOne($id);
			$this->repository->delete($cart);
		} else {
			$this->cartSession->delete($productId);
		}


		echo json_encode(['success' => 'ok']);
	}

	public function actionDrop()
	{
		if (!is_null($this->userId)) {
			$this->repository->deleteAll($this->userId);
		} else {
			$this->cartSession->deleteAll();
		}

		// TODO доделать очистку корзины в сессии

		echo json_encode(['success' => 'ok']);

	}

}
