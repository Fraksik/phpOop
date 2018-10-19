<?php /** @var \app\models\Product $model */ ?>

<div class="catalog">
<?php foreach ($model as $product): ?>
	<div class="product">
	<h2><a href="<?= "index.php?c=product&a=card&id={$product->id}" ?>"><?= $product->name ?></a></h2>
	<p><?= $product->description ?></p>
	<p><?= $product->price ?></p>
	</div>
<?php endforeach; ?>
</div>
<br>
<a href="index.php?c=cart">Корзина</a>
<br>