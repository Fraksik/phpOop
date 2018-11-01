<?php

namespace app\models;

class Orders extends DataEntity
{
	public $id;
	public $userId;
	public $status;
	public $order_date;

	public function __construct($userId = null)
	{
		$this->userId = $userId;
		$this->status = 'new';
		$this->order_date = date(' H:m d.m.y');
	}
}