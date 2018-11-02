<?php

namespace app\models\repositories\session;

use app\base\App;
use app\models\Cart;

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
		$data = $this->productInCart($productId);
		$this->session->set('cart', $data);
	}

	public function delete($productId)
	{
		$data = $this->session->get('cart');
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
		if (is_null($session)) {
			$this->session->set('cart', []);
		}
		$res = [];
		foreach ($session as $key => $value) {
			$arr = App::call()->productDb->getOneArr($key);
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

	public function moveCart()
	{
		$cart = $this->session->get('cart');

		if (!is_null($cart)) {
			$userId = $this->session->get('userId');

			foreach ($cart as $productId => $count) {
				App::call()->cartDb->save(new Cart($productId, $userId, $count));
			}
		}

	}

}