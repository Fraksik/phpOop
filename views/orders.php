<a href="/login">Авторизация</a><br>
<a href="/product">Каталог</a><br>
<a href="/cart">Корзина</a><br>
<a href="/orders">Заказы</a><br><br>

<table class="orders">
	<?php foreach ($orders as $order): ?>
		<tr>
			<td>Заказ № <?=$order->id?></td>
			<td class="orders_status_field">Статус: <span class="order_status_<?=$order->status?>"
					id="order_status_<?=$order->id?>"><?=$order->status?></span></td>
			<td>Оформлен: <span class="order_date"><?=$order->order_date?></span></td>
			<td>
				<form action="orders/showOrder" method="post">
					<input type="hidden" name="id" value="<?=$order->id?>">
					<input type="submit" value="Посмотреть заказ" class="show_order">
				</form>
			</td>
			<td><button id="cancel_order_<?=$order->id?>" data-id="<?=$order->id?>" class="cancel_order">
					Отменить заказ
				</button>
			</td>
		</tr>
	<?php endforeach; ?>
</table>
<br>

<br>

<script src="/js/orders.js"></script>