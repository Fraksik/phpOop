<?php

namespace app\models;

class Category extends DataEntity
{
	protected $id;
	protected $name;
	protected $description;

	public function __construct($name, $description)
	{
		$this->name = $name;
		$this->description = $description;
	}
}