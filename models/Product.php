<?php

namespace app\models;

class Product extends DataEntity
{
	public $id;
	public $name;
	public $description;
	public $price;
	public $producerID;

	public function __construct($name, $description, $price, $producerID)
	{
		$this->name = $name;
		$this->description = $description;
		$this->price = $price;
		$this->producerID = $producerID;
	}

}