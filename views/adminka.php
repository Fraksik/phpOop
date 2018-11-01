<a href="/user">Авторизация</a><br>
<a href="/product">Каталог</a><br>
<a href="/cart">Корзина</a><br>
<a href="/orders">Заказы</a><br>
<a href="/../product/adminka">Админка</a><br><br>

<form action="new" enctype="multipart/form-data" method="post">

	<label for="title">Название товара:</label>
	<input type="text" id="title" name="name"><br>

	<label for="description">Описание:</label>
	<textarea id = 'description' name="desc" rows="5" cols="30"></textarea><br>

	<label for="price">Цена товара:</label>
	<input type="number" id="price" name="price"><br>

	<input type="submit" value="Добавить">
</form>