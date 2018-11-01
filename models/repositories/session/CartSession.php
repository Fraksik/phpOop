<?php

namespace app\models\repositories\session;

use app\base\App;
use app\models\repositories\ProductRepository;

class CartSession
{
	private $session;

	public function __construct()
	{
		$this->session = App::call()->session;
	}


	public function add($productId)
	{
		if (is_null($this->session->get('cart'))) {
			$this->session->set('cart', []);
		}
		$data = (new CartSession())->productInCart($productId);
		$this->session->set('cart', $data);
	}

	public function delete($productId)
	{
		$this->session->get('cart');
		if ($data[$productId] > 1) {
			$data[$productId] -= 1;
		} else {
			unset($data[$productId]);
		}
		$this->session->set('cart', $data);
	}

	public function getAll()
	{
		$session = $this->session->get('cart');
		$res = [];
		foreach ($session as $key => $value) {
			$arr = (new ProductRepository())->getOneArr($key);
			$arr['count'] = $value;
			$res[] = $arr;
		}
		return $res;
	}

	public function deleteAll()
	{
		$this->session->set('cart', []);
	}

	private function productInCart($productId)
	{
		$arr = $this->session->get('cart');

		if(array_key_exists($productId, $arr)) {
			$arr[$productId] += 1;
		} else {
			$arr[$productId] = 1;
		}
		return $arr;
	}

}