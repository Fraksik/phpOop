<?php

namespace app\models\repositories\session;

use app\base\App;

class UserSession
{
	private $session;


	public function __construct()
	{
		$this->session = App::call()->session;
	}

	public function create($userName, $userId)
	{
		$this->session->set("user", "$userName");
		$this->session->set("userId", "$userId");
	}
}