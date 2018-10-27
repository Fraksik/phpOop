<?php

namespace app\models\repositories;

use app\models\Category;

class CategoryRepository extends Repository
{
	public function getTableName()
	{
		return 'category';
	}

	public function getEntityClass()
	{
		return Category::class;
	}
}