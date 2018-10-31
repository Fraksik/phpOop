<?php

namespace app\models;

use app\models\repositories\OrderRepository;

class Order extends DataEntity
{
	public $id;
	public $userId;
	public $status;
	public $order_date;

	public function __construct($userId = 1)
	{
		$this->userId = $userId;
		$this->status = 'new';
		$this->order_date = date(' H:m d.m.y');
	}

	public static function getOrderCost($orderId) {
		$cart = (new OrderRepository())->getOrder($orderId);
		$totalCost = 0;
		foreach ($cart as $product) {
			$totalCost += $product['count'] * $product['price'];
		}
		return $totalCost;
	}
}