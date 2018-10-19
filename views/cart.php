<?php /** @var \app\models\Cart $cart */?>

<div class="cart">
    <p>Корзина:</p>
	<?php foreach ($cart as $product): ?>
		<div class="cart_position">
        <p><b>id продукта <?=$product->productId?></b> - <?=$product->count?> шт. - цена/шт
	        <?=$product->cost?> руб.</p>
        </div>
	<?php endforeach; ?>
	<p>Общая стоимость: <?=$cost?> руб.</p>
	<br>
	<a href="index.php?c=product">Каталог</a>
</div>