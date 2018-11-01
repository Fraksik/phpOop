<?php

namespace app\models;

use app\models\repositories\CartRepository;
use app\models\repositories\session\CartSession;
use app\base\App;

class Cart extends DataEntity
{
	public $id;
	public $userId;
	public $productId;
	public $count;
	public $orderId;

	public function __construct($productId, $userId = null, $count = 1)
	{
		$this->userId = $userId;
		$this->productId = $productId;
		$this->count = $count;
		$this->orderId = null;

	}

	public static function getCartCost($userId = null) {
		if (is_null($userId)) {
			$cart = (new CartSession())::getAll();
		} else {
			$cart = (new CartRepository())->getAllByUser($userId);
		}
		$totalCost = 0;
		foreach ($cart as $product) {
			$totalCost += $product['count'] * $product['price'];
		}
		return $totalCost;
	}



}