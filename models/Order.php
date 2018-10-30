<?php

namespace app\models;

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
}