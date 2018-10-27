<?php

namespace app\models;

class Product extends DataEntity
{
	protected $id;
	protected $name;
	protected $description;
	protected $price;
	protected $producerID;

	public function __construct($name, $description, $price, $producerID)
	{
		$this->name = $name;
		$this->description = $description;
		$this->price = $price;
		$this->producerID = $producerID;
	}
}