<?php

namespace app\models;

class User extends DataModel
{
	protected $id;
	protected $userName;
	protected $userPass;
	protected $userRole;

	public function __construct($name, $pass, $role=2)
	{
		parent::__construct();
		$this->userName = $name;
		$this->userPass = $pass;
		$this->userRole = $role;
	}

	protected static function getTableName()
	{
		return 'user';
	}

}