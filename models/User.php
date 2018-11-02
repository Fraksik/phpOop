<?php

namespace app\models;

class User extends DataEntity
{
	public $id;
	public $name;
	public $login;
	public $pass;
	public $role;

	public function __construct($name, $login, $pass, $role=2)
	{
		$this->name = $name;
		$this->login = $login;
		$this->pass = $pass;
		$this->role = $role;
	}

}