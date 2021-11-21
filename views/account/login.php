<div class="bg-light">
<?php
\App\core\Breadcrumb::add('/account/login', 'Авторизация');
echo \App\core\Breadcrumb::out();
?>
</div>
<main class="form-signin">
<form>
    <h1 class="h3 mb-3 fw-normal" style="text-align: center">Авторизация</h1>

    <div class="form-floating">
        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Email</label>
    </div>
    <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Пароль</label>
    </div>
    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Запомнить меня
        </label>
    </div>
    <div class="text-center">
        <a style="padding: 2rem;" href="/account/register">Нет аккаунта? Зарегистрируйтесь!</a>
    </div>
    <div class="col">&#8291;</div>
    <div class="text-center">
        <button class="button_submit"  type="submit" target="_blank">Войти</button>
    </div>
</form>

    <?php


    /** @var void $model */
    foreach ($model as $user) {
        echo "Логин:".$user->getLogin().'<br>';
        echo "ФИО:".$user->getFullName().'<br>';
        echo "Роль:".$user->getRole().'<br>';
    }


    ?>
</main>