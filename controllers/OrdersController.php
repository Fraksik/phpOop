<?php

namespace app\controllers;


use app\base\App;
use app\models\Order;
use app\models\repositories\OrderRepository;
use app\services\renderers\IRenderer;

class OrdersController extends Controllers
{
	private $ordersRepository;
	private $request;
	private $session;
	private $order;
	private $userId;

	public function __construct(IRenderer $renderer, $useLayout = true)
	{
		parent::__construct($renderer, $useLayout);
		$this->ordersRepository = new OrderRepository();
		$this->request = App::call()->request;
		$this->session = App::call()->session;
		$this->userId = $this->session->get('userId');
		$this->order = new Order($this->userId);
	}

	public function actionIndex()
	{
		$orders = null;
		if (!is_null($this->userId)) {
			$orders = $this->ordersRepository->getUserOrders($this->userId);
		}
		echo $this->render("orders", ['orders' => $orders]);
	}

	public function actionCancel()
	{
		echo json_encode(['success' => 'ok']);
		$id = $this->request->post('id');
		$this->ordersRepository->cancelOrder($id);
	}

	public function actionMakeOrder()
	{
		echo json_encode(['success' => 'ok']);
		if (!is_null($this->userId)) {
			($this->ordersRepository)->create($this->order);
		}

	}

	public function actionShowOrder()
	{
		$id = $this->request->post('id');
		$cart = $this->ordersRepository->getOrder($id);
		$cost = Order::getOrderCost($id);
		echo $this->render("cart_order", ['cart' => $cart, 'cost' => $cost]);

	}
}