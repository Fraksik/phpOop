<?php

namespace app\models\repositories;

use app\models\Cart;
use app\models\DataEntity;

class CartRepository extends Repository
{
	public function getTableName()
	{
		return 'cart';
	}

	public function getEntityClass()
	{
		return Cart::class;
	}

	public function getCartCost() {
		$cart = $this->getAll();
		$totalCost = 0;
		foreach ($cart as $product) {
			$totalCost += $product['count'] * $product['price'];
		}
		return $totalCost;
	}

	public function save(DataEntity $entity) {
		$inCart = $this->getOneByEntity($entity);
		if (is_null($inCart)) {
			(new CartRepository())->create($entity);
		} else {
			$entity = $inCart;
			$entity->count += 1;
			(new CartRepository())->update($entity);
		}
	}

	public function getOneByEntity($entity) {
		$table = $this->getTableName();
		$sql = "SELECT * FROM {$table} WHERE productId =:productId AND userId =:userId AND {$table}.orderId IS NULL";
		$res = $this->db->queryOneAsObj($sql, $this->getEntityClass(), [
			'productId' => $entity->productId,
			'userId' => $entity->userId
		]);
		return $res;
	}

	public function update(DataEntity $entity)
	{
		$sql = "UPDATE {$this->getTableName()} SET count = :count WHERE productID = :productID AND userID = :userID";

		$this->db->execute($sql, [
			'productID' => $entity->productId,
			'userID' => $entity->userId,
			'count' => $entity->count
		]);
	}

	public function delete(DataEntity $entity)
	{
		$inCart = $this->getOneByEntity($entity);
		if ($inCart->count > 1) {
			$inCart->count -= 1;
			(new CartRepository())->update($inCart);
		} else {
			$sql = "delete from {$this->getTableName()} where id = :id";
			$this->db->execute($sql, [':id' => $entity->id]);
		}
	}

	public function deleteAll()
	{
		$table = $this->getTableName();
		$sql = "delete from {$table} WHERE {$table}.orderId IS NULL";
		$this->db->execute($sql, []);
	}

	public function getAll()
	{
		$table = $this->getTableName();
		$sql = "SELECT 
				{$table}.id AS cart_id, {$table}.count, 
				product.* 
				FROM {$table} INNER JOIN product ON {$table}.productId = product.id
				WHERE {$table}.orderId IS NULL";
		return $this->db->queryAll($sql, []);
	}

	public function setOrder($order)
	{
		$table = $this->getTableName();
		$sql = "UPDATE {$table} SET orderId = $order WHERE orderId IS NULL";
		$this->db->execute($sql, []);
	}

}