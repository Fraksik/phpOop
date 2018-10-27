<?php

namespace app\models\repositories;

use app\models\Cart;

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

	public static function getCartCost($userId) {
		$sql = "SELECT * FROM cart WHERE userId = :userId";
		$res = Repository::getDb()->queryAll($sql, [':userId' => $userId]);
		$cost = 0;
		foreach ($res as $product) {
			$cost+= $product['count'] * $product['cost'];
		}
		return $cost;
	}
}