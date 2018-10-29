<?php /** @var \app\models\Cart $cart */?>

<div class="cart">
    <p>Корзина:</p>
	<table id="cart_table">
	<?php foreach ($cart as $product): ?>
		<tr>
			<td><b><?=$product['name']?></b></td>
			<td>
				<span id="cart_count_id_<?=$product['id']?>"><?=$product['count']?></span> шт.
			</td>
			<td><?=$product['price']?> руб/шт.</td>
			<td class="cart_table_btn">
				<button data-id="<?=$product['id']?>"
					data-price="<?=$product['price']?>" class="cart_button_add">добавить</button>
			</td>
			<td>
				<button data-cart_id="<?=$product['cart_id']?>" data-id="<?=$product['id']?>"
					data-price="<?=$product['price']?>" class="cart_button_delete">удалить</button>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<p>Общая стоимость: <span id="cart_cost"><?=$cost?></span> руб.</p>
	<button id="make_order">Создать заказ</button>
	<button id="cart_drop">Очистить корзину</button>
	<br><br>
	<a href="/product">Каталог</a>
</div>


<script src="/js/cart.js"></script>