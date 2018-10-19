<?php

namespace app\models;

use app\interfaces\IModel;
use app\services\DB;

abstract class DataModel implements IModel
{
	protected $db;

	public function __construct()
	{
		$this->db = Db::getInstance();
	}

	abstract static protected function getTableName();

	private function getValues () {

		$tableCols = $this->getColumns();

		$arr = [];
		$columns = [];
		$params = [];
		$values = [];

		foreach($this as $key=>$value) {
			if (in_array($key, $tableCols)) {
				array_push($columns, $key);
				$values[$key] = $value;
				array_push($params, ":$key");
			}

		}

		$columns = implode(", ", $columns);
		$params = implode(", ", $params);

		$arr['columns'] = $columns;
		$arr['params'] = $params;
		$arr['values'] = $values;

		return $arr;
	}

	public function create()
	{
		$table = $this->getTableName();
		$arr = $this->getValues();
		$columns = $arr['columns'];
		$params = $arr['params'];
		$values = $arr['values'];

		$sql = "insert into {$table}($columns) values($params)";

		$this->db->execute($sql, $values);
		$this->id = $this->db->getLastId();
	}

	public static function getOne($id)
	{
		$table = static::getTableName();
		$sql = "SELECT * FROM {$table} WHERE id = :id";
		return Db::getInstance()->queryOneAsObj($sql, get_called_class(), [':id' => $id]);
	}

	public static function getAll()
	{
		$table = static::getTableName();
		$sql = "SELECT * FROM {$table}";
		return Db::getInstance()->queryAllAsObj($sql, get_called_class(), []);
	}

	public function update()
	{
		$table = $this->getTableName();

		$sql = "SELECT * FROM {$table} WHERE id = :id";
		$oldDbData =  Db::getInstance()->queryOne($sql, [':id' => $this->id]);

		$arr = $this->getValues();
		$values = $arr['values'];
		$newData = [];

		foreach ($oldDbData as $key => $value) {
			if ($values[$key] != $value) {
				$newData[$key] = $values[$key];
			}
		}

		$sql = "update {$table} set ";
		$sqlArr = [];

		foreach ($newData as $key => $data) {
			array_push($sqlArr, "$key = '$data'");
		}
		$sql .= implode(", ", $sqlArr) . " where id = {$this->id}";

		$this->db->execute($sql, $values);
	}

	public function save() {
		if (is_null($this->id)) {
			return $this->create();
		} else {
			return $this->update();
		}

	}

	public function delete()
	{
		$table = $this->getTableName();
		$sql = "delete from {$table} where id = :id";

		$this->db->execute($sql, [':id' => $this->id]);
	}

	public function show() {
		var_dump($this);
	}

	public static function getCartCost($userId) {
		$sql = "SELECT * FROM cart WHERE userId = :userId";
		$res = DB::getInstance()->queryAll($sql, [':userId' => $userId]);
		$cost = 0;
		foreach ($res as $product) {
			$cost+= $product['count'] * $product['cost'];
		}
		return $cost;
	}

	private function getColumns() {
		$table = static::getTableName();
		$sql = "show columns from {$table}";
		$res = $this->db->queryAll($sql, []);
		$arr = [];
		foreach ($res as $col) {
			array_push($arr, $col['Field']);
		}
		return $arr;
	}

}