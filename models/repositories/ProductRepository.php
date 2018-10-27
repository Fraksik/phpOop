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
}