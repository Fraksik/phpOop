<?php /** @var \app\models\Cart $cart */?>

<div class="cart">
    <p>Корзина:</p>
	<?php foreach ($cart as $product): ?>
		<div class="cart_position">
        <p><b>id продукта <?=$product->productId?></b> - <?=$product->count?> шт. - <?=$product->cost?> руб/шт.</p>
        <form action="cart/delete" method="get">
            <input type="hidden" name="id" value="<?=$product->id?>">
            <input type="submit" value="удалить" class="cart_button">
        </form>
        </div>
	<?php endforeach; ?>
	<p>Общая стоимость: <?=$cost?> руб.</p>
	<form action="cart/deleteAll" method="post">
		<input type="hidden" name="userId" value="<?=$cart[0]->userId ?? null?>">
	  <input type="submit" value="Создать заказ" name="order">
	  <input type="submit" value="Очистить корзину" name="drop_basket">
  </form>
	<br>
	<a href="/product">Каталог</a>
</div>


