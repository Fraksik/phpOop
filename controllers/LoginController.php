<?php

namespace app\controllers;

use app\base\App;
use app\models\repositories\UserRepository;
use app\models\User;
use app\services\renderers\IRenderer;

class LoginController extends Controllers
{
	private $request;
	private $session;
	private $userRepository;

	public function __construct(IRenderer $renderer, $useLayout = true)
	{
		parent::__construct($renderer, $useLayout);
		$this->request = App::call()->request;
		$this->session = App::call()->session;
		$this->userRepository = new UserRepository();
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
		$params = $this->request->getParams('post');
		$msg = User::testData($params);
		if ($msg) {
			echo $this->render("registration", ['text' => $msg]);
		}
		header("Location: /../product");
	}

	public function actionAuthorization()
	{
		$login = $this->request->post('login');
		$pass = $this->request->post('pass');
		$isUser = $this->userRepository->findUser($login, $pass);

	}
}