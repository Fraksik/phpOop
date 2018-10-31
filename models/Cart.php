<?php

namespace app\models;

use app\models\repositories\CartRepository;

class Cart extends DataEntity
{
	public $id;
	public $userId;
	public $productId;
	public $count;
	public $orderId;

	public function __construct($productId, $count = 1, $userId = 1)
	{
		$this->userId = $userId;
		$this->productId = $productId;
		$this->count = $count;
		$this->orderId = null;

	}

	public static function getCartCost() {
		$cart = (new CartRepository())->getAll();
		$totalCost = 0;
		foreach ($cart as $product) {
			$totalCost += $product['count'] * $product['price'];
		}
		return $totalCost;
	}

}