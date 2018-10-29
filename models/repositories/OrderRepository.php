<?php

namespace app\models\repositories;

use app\models\DataEntity;
use app\models\Order;

class OrderRepository extends Repository
{
	public function getTableName()
	{
		return 'orders';
	}

	public function getEntityClass()
	{
		return Order::class;
	}

	public function create(DataEntity $entity)
	{
		parent::create($entity);
		(new CartRepository())->setOrder($entity->id);
	}
}