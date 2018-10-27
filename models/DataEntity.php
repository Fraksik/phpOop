<?php

namespace app\models;

abstract class DataEntity
{
	public function __set($name, $value)
	{
		if(property_exists($this, $name)) {
			$this->$name = $value;
			$this->change[$name] = $value;
		}
	}

	public function __get($name)
	{
		if(property_exists($this, $name)) {
			return $this->$name;
		}
	}
}