<?php

namespace app\models;

class Order extends DataEntity
{
	public $id;
	public $userId;
	public $cost;
	public $status;
	public $date;

	public function __construct($userId, $cost)
	{
		$this->userId = $userId;
		$this->cost = $cost;
		$this->status = 'new';
		$this->date = date('H:m d-m-Y');
	}
}