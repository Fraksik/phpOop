<?php

namespace app\models\repositories;

use app\models\DataEntity;
use app\services\DB;

abstract class Repository implements IRepository
{
	protected $db;

	public function __construct()
	{
		$this->db = static::getDb();
	}

	public function save(DataEntity $entity)
	{
		if (is_null($entity->id)) {
			return $this->create($entity);
		} else {
			return $this->update($entity);
		}
	}

	public function create(DataEntity $entity)
	{
		$table = $this->getTableName();
		$arr = $this->getValues($entity);
		$columns = $arr['columns'];
		$params = $arr['params'];
		$values = $arr['values'];

		$sql = "insert into {$table}($columns) values($params)";

		$this->db->execute($sql, $values);
		$entity->id = $this->db->getLastId();
	}

	public function getOne($id)
	{
		$table = $this->getTableName();
		$sql = "SELECT * FROM {$table} WHERE id = :id";

		return static::getDb()->queryOneAsObj($sql, $this->getEntityClass(), [':id' => $id]);
	}

	public function getAll()
	{
		$table = $this->getTableName();
		$sql = "SELECT * FROM {$table}";
		return static::getDb()->queryAllAsObj($sql, $this->getEntityClass(), []);
	}

	public function update(DataEntity $entity)
	{
		$table = $this->getTableName();
		$arr = $this->getValues($entity);
		$values = $arr['values'];
		$change = $this->getOneArr($entity->id);

		$sql = "update {$table} set ";
		$sqlArr = [];

		foreach ($entity as $key => $data) {
			if($change[$key] != $data) {
				$sqlArr[] = "$key = '$data'";
			}
		}

		$sql .= implode(", ", $sqlArr) . " where id = {$entity->id}";

		$this->db->execute($sql, $values);
	}

	public function delete(DataEntity $entity)
	{
		$table = $this->getTableName();
		$sql = "delete from {$table} where id = :id";

		$this->db->execute($sql, [':id' => $entity->id]);
	}

	private function getValues(DataEntity $entity)
	{
		$tableCols = $this->getColumns();

		$arr = [];
		$columns = [];
		$params = [];
		$values = [];

		foreach($entity as $key => $value) {
			if (in_array($key, $tableCols))
			{
				$columns[] = $key;
				$params[] = ":$key";
				$values[$key] = $value;
			}
		}

		$columns = implode(", ", $columns);
		$params = implode(", ", $params);

		$arr['columns'] = $columns;
		$arr['params'] = $params;
		$arr['values'] = $values;

		return $arr;
	}

	private function getColumns() {
		$table = $this->getTableName();
		$sql = "show columns from {$table}";
		$res = $this->db->queryAll($sql, []);
		$arr = [];
		foreach ($res as $col) {
			$arr[] = $col['Field'];
		}
		return $arr;
	}

	private function getOneArr($id) {
		$table = $this->getTableName();
		$sql = "SELECT * FROM {$table} WHERE id = :id";

		return static::getDb()->queryOne($sql, [':id' => $id]);
	}

	protected static function getDb(){
		return Db::getInstance();
	}

}