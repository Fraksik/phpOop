<?php

namespace app\models;

class Cart extends DataEntity
{
	protected $id;
	protected $userId;
	protected $productId;
	protected $count;
	protected $cost;

	public function __construct($userId, $productId, $count, $cost)
	{
		$this->userId = $userId;
		$this->productId = $productId;
		$this->count = $count;
		$this->cost = $cost;
	}

}