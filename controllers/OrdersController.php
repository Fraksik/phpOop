<?php

namespace app\controllers;

use app\models\Orders;
use app\models\repositories\OrdersRepository;
use app\services\renderers\IRenderer;

class OrdersController extends Controllers
{
	private $order;
	private $userId;

	public function __construct(IRenderer $renderer, $useLayout = true)
	{
		parent::__construct($renderer, $useLayout);
		$this->userId = $this->session->get('userId');
		$this->order = new Orders($this->userId);
	}

	public function getRepository()
	{
		return new OrdersRepository();
	}

	public function actionIndex()
	{
		$orders = null;
		if (!is_null($this->userId)) {
			$orders = $this->repository->getUserOrders($this->userId);
		}
		echo $this->render("orders", ['orders' => $orders]);
	}

	public function actionCancel()
	{
		echo json_encode(['success' => 'ok']);
		$id = $this->request->post('id');
		$this->repository->cancelOrder($id);
	}

	public function actionMakeOrder()
	{
		echo json_encode(['success' => 'ok']);
		if (!is_null($this->userId)) {
			$this->repository->create($this->order);
		}
	}

	public function actionShowOrder()
	{
		$id = $this->request->post('id');
		$cart = $this->repository->getOrder($id);
		$cost = $this->repository->getOrderCost($id);
		echo $this->render("cart_order", ['cart' => $cart, 'cost' => $cost]);
	}
}