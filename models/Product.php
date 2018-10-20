<?php

namespace app\models;

class Product extends DataModel
{
	protected $id;
	protected $name;
	protected $description;
	protected $price;
	protected $producerID;


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