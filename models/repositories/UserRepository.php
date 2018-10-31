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

	public function findUser($login, $pass)
	{
		// TODO доделать проверку пользователя
	}

	public function matchLogin($login)
	{
		$table =$this->getTableName();
		$sql = "select id from {$table} where login=:login";
		return $this->db->queryAll($sql, ['login' => $login]);;
	}
}