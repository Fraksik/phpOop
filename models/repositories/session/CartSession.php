<?php

namespace app\models\repositories\session;


use app\base\App;
use app\models\repositories\ProductRepository;

class CartSession
{

	public function add($productId)
	{
		if (is_null(App::call()->session->get('cart'))) {
			App::call()->session->set('cart', []);
		}
		$data = (new CartSession())->productInCart($productId);
		App::call()->session->set('cart', $data);
	}

	public function delete($productId)
	{
		$data = App::call()->session->get('cart');
		if ($data[$productId] > 1) {
			$data[$productId] -= 1;
		} else {
			unset($data[$productId]);
		}
		App::call()->session->set('cart', $data);
	}

	public static function getAll()
	{
		$session = App::call()->session->get('cart');
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
		App::call()->session->set('cart', []);
	}

	private function productInCart($productId)
	{
		$arr = App::call()->session->get('cart');

		if(array_key_exists($productId, $arr)) {
			$arr[$productId] += 1;
		} else {
			$arr[$productId] = 1;
		}
		return $arr;
	}

}