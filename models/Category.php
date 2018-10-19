<?php


namespace app\models;


class Category extends DataModel
{
	protected $id;
	public $name;
	public $description;


	public function __construct($name, $description)
	{
		parent::__construct();
		$this->name = $name;
		$this->description = $description;
	}

	public static function getTableName()
	{
		return 'category';
	}

}