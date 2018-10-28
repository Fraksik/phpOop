<?php

namespace app\models;

class Cart extends DataEntity
{
	public $id;
	public $userId;
	public $productId;
	public $count;

	public function __construct($productId, $count = 1, $userId = 1)
	{
		$this->userId = $userId;
		$this->productId = $productId;
		$this->count = $count;

	}

}