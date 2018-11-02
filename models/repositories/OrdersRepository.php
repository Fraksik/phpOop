<?php

namespace app\models\repositories;

use app\base\App;
use app\models\DataEntity;
use app\models\Orders;

class OrdersRepository extends Repository
{

	public function getTableName()
	{
		return 'orders';
	}

	public function getEntityClass()
	{
		return Orders::class;
	}

	public function create(DataEntity $entity)
	{
		parent::create($entity);
		App::call()->cartDb->setOrder($entity->id);
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

	public function getOrder($orderId)
	{
		$table = App::call()->cartDb->getTableName();
		$sql = "SELECT 
				{$table}.id AS cart_id, {$table}.count, {$table}.orderId,
				product.* 
				FROM {$table} INNER JOIN product ON {$table}.productId = product.id
				WHERE {$table}.orderId =:orderId";
		return $this->db->queryAll($sql, [':orderId' => $orderId]);
	}

	public function getOrderCost($orderId) {
		$cart = $this->getOrder($orderId);
		$totalCost = 0;
		foreach ($cart as $product) {
			$totalCost += $product['count'] * $product['price'];
		}
		return $totalCost;
	}

}