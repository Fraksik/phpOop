<?php

namespace app\models;

class User extends DataEntity
{
	protected $id;
	protected $userName;
	protected $userPass;
	protected $userRole;

	public function __construct($name, $pass, $role=2)
	{
		$this->userName = $name;
		$this->userPass = $pass;
		$this->userRole = $role;
	}
}