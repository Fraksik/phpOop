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
}