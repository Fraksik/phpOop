<?php

namespace app\interfaces;


interface IModel
{
	public function create();

	public static function getOne($id);

	public static function getAll();

	public function update();

	public function delete();

	public function save();
}