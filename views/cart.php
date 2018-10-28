<?php /** @var \app\models\Cart $cart */?>

<div class="cart">
    <p>Корзина:</p>
	<table class="cart_table">
	<?php foreach ($cart as $product): ?>
	<tr>
		<td><b><?=$product['name']?></b></td>
		<td><?=$product['count']?> шт.</td>
		<td><?=$product['price']?> руб/шт.</td>
		<td class="cart_table_btn">
			<form action="cart/add" method="post">
            <input type="hidden" name="id" value="<?=$product['id']?>">
            <input type="submit" value="добавить" class="cart_button_add">
			</form>
		</td>
		<td class="cart_table_btn">
			<form action="cart/delete" method="post">
            <input type="hidden" name="id" value="<?=$product['cart_id']?>">
            <input type="submit" value="удалить" class="cart_button_delete">
			</form>
		</td>
		</tr>
	<?php endforeach; ?>
	</table>
<!--	<p>Общая стоимость: --><?//=$cost?><!-- руб.</p>-->
	<form action="cart/deleteAll" method="post">
		<input type="hidden" name="userId" value="<?=$cart[0]->userId ?? null?>">
	  <input type="submit" value="Создать заказ" name="order">
	  <input type="submit" value="Очистить корзину" name="drop_basket">
  </form>
	<br>
	<a href="/product">Каталог</a>
</div>


