<?php /** @var \app\models\Product $model */?>

<a href="/product">Каталог</a><br>
<a href="/cart">Корзина</a><br>
<a href="/orders">Заказы</a><br><br>

<div class="item">
	<h1><?=$model->name?></h1>
	<p><?=$model->description?></p>
</div>

<br>
