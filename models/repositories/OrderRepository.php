<?php

namespace app\models\repositories;

use app\models\Order;

class OrderRepository extends Repository
{
	public function getTableName()
	{
		return 'order';
	}

	public function getEntityClass()
	{
		return Order::class;
	}
}