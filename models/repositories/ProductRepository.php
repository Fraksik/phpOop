<?php

namespace app\models\repositories;

use app\models\Product;

class ProductRepository extends Repository
{
	public function getTableName()
	{
		return 'product';
	}

	public function getEntityClass()
	{
		return Product::class;
	}

	public function getPrice($id) {
		$sql = "SELECT price FROM product where id = :id";
		$res = $this->db->queryOne($sql, [':id' => $id]);
		return $res['price'];
	}


}