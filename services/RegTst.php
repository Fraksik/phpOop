<?php

namespace app\services;


use app\base\App;

class RegTst
{
	private $msg;
	private $userDb;

	public function __construct()
	{
		$this->msg = [];
		$this->userDb = App::call()->userDb;
	}


	public function test($data)
	{
		$this->testEmptyData($data);
		$this->testUniqueLogin($data['login']);
		$this->testVerifyPass($data['pass'], $data['pass_2']);
		return $this->msg;
	}

	private function testEmptyData($data)
	{
		foreach ($data as $field) {
			if ($field == "") {
				return $this->msg[] = "Все поля должны быть заполнены!";
			}
		}
	}

	private function testUniqueLogin($login)
	{
		$testLogin = $this->userDb->matchLogin($login);
		if ($login === "") {
			return;
		}
		else if (!empty($testLogin)) {
			$this->msg[] = "Этот логин \"$login\" уже занят, пожалуйста придумайте другой логин!";
		}
	}

	private function testVerifyPass($pass, $pass2)
	{
		if ($pass !== $pass2) {
			$this->msg[] = "Поля для ввода пароля должны быть идентичны!";
		}
	}
}