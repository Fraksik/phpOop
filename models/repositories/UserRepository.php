<?php

namespace app\models\repositories;

use app\models\DataEntity;
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
		$table =$this->getTableName();
		$sql = "SELECT `name`, id, pass FROM {$table} WHERE login=:login";
		$res = $this->db->queryOne($sql, ['login' => $login]);
		if (empty($res)) {
			return false;
		}
		if (password_verify($pass, $res['pass'])) {
			unset($res['pass']);
			return $res;
		}
		return false;
	}

	public function matchLogin($login)
	{
		$table =$this->getTableName();
		$sql = "select id from {$table} where login=:login";
		return $this->db->queryOne($sql, ['login' => $login]);
	}

	public function create(DataEntity $entity)
	{
		$table = $this->getTableName();
		$pass = password_hash($entity->pass, PASSWORD_DEFAULT);

		$sql = "INSERT INTO {$table}(`name`, login, pass, role ) VALUES(:name, :login, :pass, :role)";

		$this->db->execute($sql, [
			'name' => $entity->name,
			'login' => $entity->login,
			'pass' => $pass,
			'role' =>$entity->role
		]);
		$entity->id = $this->db->getLastId();
	}
}