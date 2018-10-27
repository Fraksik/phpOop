<?php /** @var \app\models\Product $model */ ?>

<div class="catalog">
<?php foreach ($model as $product): ?>
	<div class="product">
		<h2><a href="<?= "product/card?id={$product->id}" ?>"><?=$product->name?></a></h2>
		<p><i> <?=$product->description?></i></p>
		<p><?=$product->price?> руб.</p>
		<form action="/catalog/add" method="get">
	        <input type="hidden" value="<?=$product->id?>" name="id">
	        <input type="submit" value="В корзину" class="catalog_button">
		</form>
	</div>
<?php endforeach;?>
</div>
<br>
<a href="/cart">Корзина</a>
<br>