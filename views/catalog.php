<?php /** @var \app\models\Product $model */ ?>

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
<br>
<a href="/cart">Корзина</a>
<br>

<script src="/js/cart.js"></script>