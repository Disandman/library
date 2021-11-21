<div class="bg-light">
<?php
\App\core\Breadcrumb::add('/user/index', 'Пользователи');
\App\core\Breadcrumb::add_current('/user/create', 'Добавление пользователя');
echo \App\core\Breadcrumb::out();

/** @var array $model */
/** @var array $role */
?>
</div>



    <div class="col">
        <h1>Создание пользователя</h1>
    </div>


<form method="post" action = "/user/create">
    <div class="form-group">
        <label for="full_name">ФИО</label>
        <input type="text" class="form-control" id="full_name" name="full_name">
    </div>
    <br>
    <div class="form-group">
        <label for="login">Логин</label>
        <input type="text" class="form-control" id="login" name="login">
    </div>
    <br>
    <div class="form-group">
        <label for="password">Пароль</label>
        <input type="password" class="form-control" id="exampleInputPassword" name="password">
    </div>
    <br>
    <div class="form-group">
        <label for="exampleFormControlStatus">Статус</label>
        <select class="form-control" id="exampleFormControlStatus" name="status">
            <option value="1"><?php echo \App\models\UserModels::$status[1]?></option>
            <option value="0"><?php echo \App\models\UserModels::$status[0]?></option>
        </select>
    </div>
    <br>
    <div class="form-group">
        <label for="exampleFormControlRole">Роль</label>
        <select class="form-control" id="exampleFormControlRole"  name="role">

            <?php foreach($role as $roles) : ?>
            <option value="<?php echo $roles->getIdRole(); ?>"><?php echo $roles->getName(); ?></option>
            <?php endforeach; ?>

        </select>
    </div>
    <br>
    <button type="submit" class="btn btn-outline-success">Создать</button>
</form>