<?php

namespace app\controllers;

use app\models\repositories\session\CartSession;
use app\models\repositories\session\UserSession;
use app\models\repositories\UserRepository;
use app\models\User;
use app\services\renderers\IRenderer;

class UserController extends Controllers
{
	private $cartSession;
	private $userSession;

	public function __construct(IRenderer $renderer, $useLayout = true)
	{
		parent::__construct($renderer, $useLayout);
		$this->cartSession = new CartSession();
		$this->userSession = new UserSession();
	}


	public function getRepository()
	{
		return new UserRepository();
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
		$msg = User::testData($data);

		if (!empty($msg)) {
			echo $this->render("registration", ['text' => $msg]);
			exit;
		}

		$user = new User($data['user'], $data['login'], $data['pass']);
		$this->repository->create($user);
		$this->userSession->create($user->name, $user->id);
		$this->cartSession->moveCart();

		header("Location: /../product");
	}

	public function actionAuthorization()
	{
		$login = $this->request->post('login');
		$pass = $this->request->post('pass');
		$user = $this->repository->findUser($login, $pass);
		if ($user) {
			$this->session->set("user", "{$user['name']}");
			$this->session->set("userId", "{$user['id']}");
			header("Location: /../product");
		}
		$msg = "Вы ввели некорректные данные!";
		echo $this->render("login", ['msg' => $msg]);
	}
}