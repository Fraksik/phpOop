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

	public function getCartCost($userId) {
		$sql = "SELECT * FROM cart WHERE userId = :userId";
		$res = Repository::getDb()->queryAll($sql, [':userId' => $userId]);
		$cost = 0;
		foreach ($res as $product) {
			$cost+= $product['count'] * $product['cost'];
		}
		return $cost;
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
		$sql = "SELECT * FROM cart where productID =:productID and userID =:userID";
		$res = static::getDb()->queryOneAsObj($sql, $this->getEntityClass(), [
			'productID' => $entity->productId,
			'userID' => $entity->userId
		]);
		return $res;
	}

	public function update(DataEntity $entity)
	{
		$sql = "UPDATE cart SET count = :count WHERE productID = :productID AND userID = :userID";

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
			$sql = "delete from cart where id = :id";
			$this->db->execute($sql, [':id' => $entity->id]);
		}
	}

	public function deleteAll($userId)
	{
		$sql = "delete from cart where userId = :userId";
		$this->db->execute($sql, [':userId' => $userId]);
	}

}