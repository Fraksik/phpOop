<?php

namespace app\controllers;

class EmptyController extends Controllers
{
	public function actionIndex()
	{
		echo $this->render("empty", []);
	}
}