<?php

namespace app\controllers;

use app\base\App;
use app\models\User;
use app\services\renderers\IRenderer;

class UserController extends Controllers
{
	private $regTst;

	public function __construct(IRenderer $renderer, $useLayout = true)
	{
		parent::__construct($renderer, $useLayout);
		$this->regTst = App::call()->regTst;
	}

	public function actionIndex()
	{
		echo $this->render("login", []);
	}

	public function actionRegistration()
	{
		echo $this->render("registration", []);
	}

	public function actionNewUser()
	{
		$data = $this->request->getParams('post');
		$msg = $this->regTst->test($data);

		if (!empty($msg)) {
			echo $this->render("registration", ['text' => $msg]);
			exit;
		}

		$user = new User($data['user'], $data['login'], $data['pass']);
		$this->userDb->create($user);

		$this->userSes->create($user->name, $user->id);
		$this->cartSes->moveCart();

		header("Location: /../product");
	}

	public function actionAuthorization()
	{
		$login = $this->request->post('login');
		$pass = $this->request->post('pass');
		$user = $this->userDb->findUser($login, $pass);
		if ($user) {
			$this->session->set("user", "{$user['name']}");
			$this->session->set("userId", "{$user['id']}");
			header("Location: /../product");
		}
		$msg = "Вы ввели некорректные данные!";
		echo $this->render("login", ['msg' => $msg]);
	}
}