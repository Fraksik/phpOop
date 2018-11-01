<a href="/../product">Перейти в каталог</a>
<div class="login_container">
	  <form action="user/authorization" method="post" class="login_check_in">
	      <div class="login_field">
	          <label for="login">Логин:</label>
	          <input type="text" name="login" id="login_login">
	      </div>
	      <div class="login_field">
	          <label for="pass">Пароль:</label>
	          <input type="password" name="pass" id="pass">
	      </div>
	      <input type="submit" value="Войти">
		  <div class="reg_warning">
	            <p><?=$msg ?? null?></p>
		  </div>
	  </form>
</div>
<a href="user/registration">Регистрация</a>
