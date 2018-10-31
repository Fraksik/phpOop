<?php

namespace app\models;

class User extends DataEntity
{
	public $id;
	public $userName;
	public $userPass;
	public $userRole;

	public function __construct($name, $pass, $role=2)
	{
		$this->userName = $name;
		$this->userPass = $pass;
		$this->userRole = $role;
	}

	public static function testData($data)
	{
		$empty = User::testEmptyData($data);
		if ($empty) {
			return $empty;
		}

	}

	private static function testEmptyData($arr)
	{
		foreach ($arr as $key => $value) {
			if ($value == '') {
				return "Все поля должны быть заполнены!";
			}
		}
		return false;
	}



}