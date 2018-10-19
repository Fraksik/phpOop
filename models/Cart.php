<?php

namespace app\models;


class Cart extends DataModel
{
	protected $id;
	public $userId;
	public $productId;
	public $count;
	public $cost;

	public function __construct($userId, $productId, $count, $cost)
	{
		parent::__construct();
		$this->userId = $userId;
		$this->productId = $productId;
		$this->count = $count;
		$this->cost = $cost;
	}

	protected static function getTableName()
	{
		return 'cart';
	}

}