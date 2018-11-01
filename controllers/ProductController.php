<?php

namespace app\controllers;

use app\models\Product;
use app\models\repositories\ProductRepository;

class ProductController extends Controllers
{

	public function getRepository()
	{
		return new ProductRepository();
	}

	public function actionIndex()
    {
    	$user = $this->session->get('user');
    	if (is_null($user)) {
		    $user = "незнакомец";
	    }
	    $msg = "Добро пожаловать, $user!";
	    $model = $this->repository->getAll();
	    echo $this->render("catalog", ['model' => $model, 'text' => $msg]);
    }

    public function actionCard()
    {
        $id = $this->request->get('id');
        $model = $this->repository->getOne($id);
        echo $this->render("card", ['model' => $model]);
    }

    public function actionAdminka()
    {
	    echo $this->render("adminka", []);
    }

    public function actionNew()
    {
    	$name = $this->request->post('name');
    	$price = $this->request->post('price');
    	$desc = $this->request->post('desc');

    	$this->repository->save(new Product($name, $desc, $price));

	    header("Location: /../product");
    }

}