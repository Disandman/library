<div class="bg-light">
<?php
\App\core\Breadcrumb::add('/account/login', 'Авторизация');
echo \App\core\Breadcrumb::out();
?>
</div>
<main class="form-signin">
<form action = "/account/login" method = "POST">
    <h1 class="h3 mb-3 fw-normal" style="text-align: center">Авторизация</h1>

    <div class="form-floating">
        <input type="text" class="form-control" id="floatinglogin" name = "login" placeholder="Login">
        <label for="floatingInput">Логин</label>
    </div>
    <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" name = "password" placeholder="Password">
        <label for="floatingPassword">Пароль</label>
    </div>
    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Запомнить меня
        </label>
    </div>
    <div class="text-center">
        <button class="button_submit"  type="submit" target="_blank">Войти</button>
    </div>
</form>
</main>