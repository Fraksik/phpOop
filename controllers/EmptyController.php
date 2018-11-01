<?php

namespace app\controllers;

class EmptyController extends Controllers
{
	public function getRepository()
	{
		return null;
	}

	public function actionIndex()
	{
		echo $this->render("empty", []);
	}
}