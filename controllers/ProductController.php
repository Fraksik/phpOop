<?php


namespace app\controllers;


use app\models\Product;

class ProductController extends ControllersModel
{
	protected $layout = "main";

    public function run($action = null)
    {
        $this->action = $action ?: $this->defaultAction;
        $method = "action" . ucfirst($this->action);
        if(method_exists($this, $method)){
            $this->$method();
        }else{
            echo "404";
        }

    }


    public function actionIndex()
    {
	    $model = Product::getAll();
	    echo $this->render("catalog", ['model' => $model]);
    }

    public function actionCard()
    {
        $id = $_GET['id'];
        $model = Product::getOne($id);
        echo $this->render("card", ['model' => $model]);
    }


    
}