<?php

namespace app\models;

class Cart extends DataEntity
{
	public $id;
	public $userId;
	public $productId;
	public $count;
	public $cost;

	public function __construct($userId, $productId, $count, $cost)
	{
		$this->userId = $userId;
		$this->productId = $productId;
		$this->count = $count;
		$this->cost = $cost;
	}

}