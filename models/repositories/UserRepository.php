<?php

namespace app\models\repositories;

use app\models\User;

class UserRepository extends Repository
{
	public function getTableName()
	{
		return 'user';
	}

	public function getEntityClass()
	{
		return User::class;
	}
}