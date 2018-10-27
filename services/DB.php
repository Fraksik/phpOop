<?php

namespace app\services;

use app\traits\TSingleton;

class DB
{
	use TSingleton;

	private $config = [
		'driver' => 'mysql',
		'host' => 'phpOop',
		'login' => 'php',
		'password' => '',
		'database' => 'phpOop',
		'charset' => 'utf8'
	];

	protected $conn = null;

	protected function getConnection()
	{
		if (is_null($this->conn)) {
			$this->conn = new \PDO(
				$this->prepareDsnString(),
				$this->config['login'],
				$this->config['password']
			);
			$this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
		}
		return $this->conn;
	}

	private function query(string $sql, array $params = [])
	{
		$pdoStatement = $this->getConnection()->prepare($sql);
		$pdoStatement->execute($params);
		return $pdoStatement;
	}

	public function execute(string $sql, array $params = [])
	{
		$this->query($sql, $params);
	}

	public function queryAllAsObj(string $sql, $className, array $params = []) {
		$arr = [];
		$res = $this->query($sql, $params)->fetchAll();
		foreach ($res as $number => $obj) {
			$properties = [];
			foreach ($obj as $key => $value) {
				if ($key != 'id') {
					array_push($properties, $value);
				}
			}
			$resOne = $this->query($sql, $params);
			$resOne->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, $className, $properties);
			array_push($arr, $resOne->fetchAll()[$number]);

		}
		return $arr;
	}

	public function queryOneAsObj(string $sql, $className, array $params = []) {
		$res = $this->queryAllAsObj($sql,$className, $params);
		if (empty($res)) {
			return null;
		}
		return $res[0];
	}

	public function queryAll(string $sql, array $params = [])
	{
		return $this->query($sql, $params)->fetchAll();
	}

	public function queryOne(string $sql, array $params = [])
	{
		$res = $this->queryAll($sql, $params);
		if (empty($res)) {
			return null;
		}
		return $res[0];
	}

	private function prepareDsnString(): string
	{
		return sprintf("%s:host=%s;dbname=%s;charset=%s",
			$this->config['driver'],
			$this->config['host'],
			$this->config['database'],
			$this->config['charset']
		);
	}

	public function getLastId () {
		return $this->getConnection()->lastInsertId();
	}
}
