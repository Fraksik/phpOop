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

	public function getUserOrders($userId)
	{
		$table = $this->getTableName();
		$sql = "SELECT * FROM {$table} WHERE userId = :userId";
		return $this->db->queryAllAsObj($sql, $this->getEntityClass(), ['userId' => $userId]);
	}

	public function cancelOrder($id)
	{
		$table = $this->getTableName();
		$sql = "UPDATE {$table} SET status = 'canceled' WHERE id = :id";
		$this->db->execute($sql, ['id' => $id]);
	}

}