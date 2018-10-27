<?php

namespace app\models;

class Category extends DataEntity
{
	public $id;
	public $name;
	public $description;

	public function __construct($name, $description)
	{
		$this->name = $name;
		$this->description = $description;
	}
}