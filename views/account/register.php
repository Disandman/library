<div class="bg-light">
<?php
\App\core\Breadcrumb::add('/account/index', 'Аккаунт');
\App\core\Breadcrumb::add('/account/register', 'Регистрация');
echo \App\core\Breadcrumb::out();
?>
</div>
<main class="form-signin">
    <form>
        <h1 class="h3 mb-3 fw-normal" style="text-align: center">Регистрация</h1>

        <div class="form-floating">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Пароль</label>
        </div>
        <div class="text-center">
            <button class="button_submit"  type="submit" target="_blank">Зарегистрироваться</button>
        </div>
    </form>
</main>