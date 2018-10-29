<?php

namespace app\models;

class Order extends DataEntity
{
	public $id;
	public $userId;
	public $status;
	public $date;

	public function __construct($userId = 1)
	{
		$this->userId = $userId;
		$this->status = 'new';
		$this->date = date('Y-m-d H:m');
	}
}