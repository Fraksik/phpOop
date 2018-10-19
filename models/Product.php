<?php

namespace app\models;

class Product extends DataModel
{
	public $id;
	public $name;
	public $description;
	public $price;
	public $producerID;
	public $test = 5;

	public function __construct($name, $description, $price, $producerID)
	{
		parent::__construct();
		$this->name = $name;
		$this->description = $description;
		$this->price = $price;
		$this->producerID = $producerID;
	}

	public static function getTableName()
	{
		return 'product';
	}

}