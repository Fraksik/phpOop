<?php

namespace app\models\repositories;

use app\models\DataEntity;
use app\models\Order;

class OrderRepository extends Repository
{
	private $cartRepository;


	public function __construct()
	{
		parent::__construct();
		$this->cartRepository = new CartRepository();
	}


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
		$this->cartRepository->setOrder($entity->id);
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
		$table = $this->cartRepository->getTableName();
		$sql = "SELECT 
				{$table}.id AS cart_id, {$table}.count, {$table}.orderId,
				product.* 
				FROM {$table} INNER JOIN product ON {$table}.productId = product.id
				WHERE {$table}.orderId =:orderId";
		return $this->db->queryAll($sql, [':orderId' => $orderId]);
	}

}