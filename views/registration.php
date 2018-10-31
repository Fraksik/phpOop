<form action="newUser" method="post" class="reg_registration">
    <div class="reg_field">
        <label for="user">Имя:</label>
        <input type="text" id="reg_user" name="user"><br>
    </div>
    <div class="reg_field">
        <label for="login">Логин:</label>
        <input type="text" id="reg_login" name="login"><br>
    </div>
    <div class="reg_field">
        <label for="pass">Пароль:</label>
        <input type="password" id="reg_pass" name="pass"><br>
    </div>
    <div class="reg_field">
        <label for="pass_2">Повторить пароль:</label>
        <input type="password" id="pass_2" name="pass_2"><br>
        <p class="reg_warning"><?=$text ?? null ?></p>
    </div>
    <input type="submit">
</form>
<a href="/../login">Авторизация</a>