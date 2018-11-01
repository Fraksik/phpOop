<?php /** @var \app\models\Product $model */ ?>

<a href="/user">Авторизация</a><br>
<a href="/product">Каталог</a><br>
<a href="/cart">Корзина</a><br>
<a href="/orders">Заказы</a><br>
<a href="/../product/adminka">Админка</a><br><br>

<h2><?=$text ?? null?></h2>
<div class="catalog">
<?php foreach ($model as $product): ?>
	<div class="product">
		<h2><a href="<?= "product/card?id={$product->id}" ?>"><?=$product->name?></a></h2>
		<p><i> <?=$product->description?></i></p>
		<p><?=$product->price?> руб.</p>
		<button data-id="<?=$product->id?>" class="catalog_add">В корзину</button>
	</div>
<?php endforeach;?>
</div>

<script src="/js/cart.js"></script>