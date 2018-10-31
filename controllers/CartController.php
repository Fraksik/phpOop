<?php

namespace app\controllers;

use app\base\App;
use app\models\Cart;
use app\models\repositories\CartRepository;
use app\services\renderers\IRenderer;

class CartController extends Controllers
{
	private $request;
	private $session;
	private $cartRepository;
	private $userId;


	public function __construct(IRenderer $renderer, $useLayout = true)
	{
		parent::__construct($renderer, $useLayout);
		$this->request = App::call()->request;
		$this->session = App::call()->session;
		$this->cartRepository = new CartRepository();
		$this->userId = $this->session->get('userId');
	}

	public function actionIndex()
	{
		$cart = null;
		$cost = 0;

		// TODO доделать подгрузку товаров из сессии

		if (!is_null($this->userId)) {
			$cart = $this->cartRepository->getAllByUser($this->userId);
			$cost = Cart::getCartCost($this->userId);
		}
		echo $this->render("cart", ['cart' => $cart, 'cost' => $cost]);
	}

	public function actionAdd() {
		$id = $this->request->post('id');

		// TODO доделать подгрузку товаров в сессию

		if (!is_null($this->userId)) {
			$this->cartRepository->save(new Cart($id, $this->userId));
		}
		echo json_encode(['success' => 'ok']);
	}

	public function actionDelete()
	{
		$id = $this->request->post('cart_id');

		// TODO доделать удаление товаров из сессии

		$cart = $this->cartRepository->getOne($id);
		$this->cartRepository->delete($cart);
		echo json_encode(['success' => 'ok']);
	}

	public function actionDrop()
	{
		if (!is_null($this->userId)) {
			$this->cartRepository->deleteAll($this->userId);
		}

		// TODO доделать очистку корзины в сессии

		echo json_encode(['success' => 'ok']);

	}

}
