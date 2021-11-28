<div class="bg-light">
<?php
\App\core\Breadcrumb::add('/user/index', 'Пользователи');
\App\core\Breadcrumb::add_current('/user/create', 'Изменение пользователя');
echo \App\core\Breadcrumb::out();
require dirname(__DIR__) . '/../config/bootstrap.php';

/** @var array $model */
/** @var array $role */
?>
</div>


    <div class="col">
        <h1>Изменение: <?php echo $model->getLogin() ?></h1>
    </div>


<form method="post" action = "/user/update?id=<?php echo $model->getIdUser()?>">


    <div class="form-group">
        <label for="full_name">ФИО</label>
        <input type="text" class="form-control" id="full_name" value="<?php echo $model->getFullName() ?>" name="full_name">
    </div>
    <br>
    <div class="form-group">
        <label for="login">Логин</label>
        <input type="text" class="form-control" value="<?php echo $model->getLogin() ?>" id="login" name="login">
    </div>
    <br>
    <div class="form-group">
        <label for="password">Новый пароль</label>
        <input type="password" class="form-control" id="exampleInputPassword" name="password">
    </div>
    <br>
    <div class="form-group">
        <label for="exampleFormControlStatus">Статус</label>
        <select class="form-control" id="exampleFormControlStatus" name="status">
            <option <?php echo $model->getActive() == 1 ? 'selected' : ''?> value="1"><?php echo \App\models\UserModels::$status[1]?></option>
            <option <?php echo $model->getActive() == 0 ? 'selected' : ''?> value="0"><?php echo \App\models\UserModels::$status[0]?></option>
        </select>
    </div>
    <br>
    <div class="form-group">
        <label for="exampleFormControlRole">Роль</label>
        <select class="form-control" id="exampleFormControlRole" name="role[]">

            <?php foreach($role as $roles) : ?>
                <option value="<?php echo $roles->getIdRole(); ?>"><?php echo $roles->getName(); ?></option>
            <?php endforeach; ?>

        </select>
    </div>
    <br>
    <button type="submit" class="btn btn-outline-success">Сохранить</button>
</form>