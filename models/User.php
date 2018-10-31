<?php

namespace app\models;

use app\models\repositories\UserRepository;

class User extends DataEntity
{
	public $id;
	public $name;
	public $login;
	public $pass;
	public $role;
	private static $msg;

	public function __construct($name, $login, $pass, $role=2)
	{
		$this->name = $name;
		$this->login = $login;
		$this->pass = $pass;
		$this->role = $role;
	}

	public static function testData($data)
	{
		User::$msg = [];
		User::testEmptyData($data);
		User::testUniqueLogin($data['login']);
		User::testVerifyPass($data['pass'], $data['pass_2']);
		return User::$msg;
	}

	private static function testEmptyData($data)
	{
		foreach ($data as $field) {
			if ($field == "") {
				return User::$msg[] = "Все поля должны быть заполнены!";
			}
		}
	}

	private static function testUniqueLogin($login)
	{
		$testLogin = (new UserRepository())->matchLogin($login);
		if ($login === "") {
			return;
		}
		else if (!empty($testLogin)) {
			User::$msg[] = "Этот логин \"$login\" уже занят, пожалуйста придумайте другой логин!";
		}
	}

	private static function testVerifyPass($pass, $pass2)
	{
		if ($pass !== $pass2) {
			User::$msg[] = "Поля для ввода пароля должны быть идентичны!";
		}
	}



}