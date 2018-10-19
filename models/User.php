<?php

namespace app\models;

class User extends DataModel
{
	protected $id;
	public $userName;
	public $userPass;
	public $userRole;

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