<?php /** @var \app\models\Product $model */?>

<a href="/login">Авторизация</a><br>
<a href="/product">Каталог</a><br>
<a href="/cart">Корзина</a><br>
<a href="/orders">Заказы</a><br><br>

<div class="item">
	<h1><?=$model->name?></h1>
	<p><?=$model->description?></p>
</div>
<br>
<button data-id="<?=$model->id?>" id="add_to_cart">В корзину</button>

<br>
<script src="/js/card.js"></script>
