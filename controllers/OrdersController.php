<?php

namespace app\controllers;


use app\base\App;
use app\models\repositories\OrderRepository;
use app\services\renderers\IRenderer;

class OrdersController extends Controllers
{
	private $ordersRepository;
	private $request;

	public function __construct(IRenderer $renderer, $useLayout = true)
	{
		parent::__construct($renderer, $useLayout);
		$this->ordersRepository = new OrderRepository();
		$this->request = App::call()->request;
	}

	public function actionIndex()
	{
		$userId = 1;
		$orders = $this->ordersRepository->getUserOrders($userId);
		echo $this->render("orders", ['orders' => $orders]);
	}

	public function actionCancel()
	{
		echo json_encode(['success' => 'ok']);
		$id = $this->request->post('id');
		$this->ordersRepository->cancelOrder($id);
	}
}