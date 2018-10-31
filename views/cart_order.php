<?php /** @var \app\models\Cart $cart */?>

<a href="/login">Авторизация</a><br>
<a href="/product">Каталог</a><br>
<a href="/cart">Корзина</a><br>
<a href="/orders">Заказы</a><br><br>

<div class="cart">
    <p>Заказ №: <?=$cart[0]['orderId']?></p>
	<table id="cart_table">
	<?php foreach ($cart as $product): ?>
		<tr>
			<td><b><?=$product['name']?></b></td>
			<td>
				<span id="cart_count_id_<?=$product['id']?>"><?=$product['count']?></span> шт.
			</td>
			<td><?=$product['price']?> руб/шт.</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<p>Общая стоимость: <span id="cart_cost"><?=$cost?></span> руб.</p>
</div>
