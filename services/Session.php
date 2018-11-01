<?php


namespace app\services;


class Session
{

	public function __construct()
	{
		session_start();
	}

	public function get($key)
	{
		if (!array_key_exists($key, $_SESSION)) {
			return null;
		} else if (is_array($key)) {
			$arr = [];
			foreach ($key as $dataKey => $value) {
				$arr[] = [$dataKey => $value];
			}
			return $arr;
		} else {
			return $_SESSION[$key];
		}
	}

	public function set($key, $data)
	{

			return $_SESSION[$key] = $data;

	}


}