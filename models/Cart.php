<?php

namespace app\models;

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
}