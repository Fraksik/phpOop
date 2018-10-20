<?php

namespace app\models;


class Order extends DataModel
{
	protected $id;
	protected $userId;
	protected $cost;
	protected $status;
	protected $date;

	public function __construct($userId, $cost)
	{
		parent::__construct();
		$this->userId = $userId;
		$this->cost = $cost;
		$this->status = 'new';
		$this->date = date('H:m d-m-Y');

	}

	protected static function getTableName()
	{
		return 'order';
	}

}