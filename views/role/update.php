<?php

use App\core\Breadcrumb;

Breadcrumb::add('/user/index', 'Пользователи');
Breadcrumb::add_current('/user/create', 'Изменение роли');

/** @var array $model */
?>

<div class="bg-light">
    <?php echo Breadcrumb::out(); ?>
</div>

<div class="col">
    <h1>Изменение роли: <?php echo $model->getName(); ?></h1>
</div>
<form method="post" action="/role/update?id=<?php echo $model->getIdRole() ?>">

    <div class="form-group">
        <label for="role">Роль</label>
        <input type="text" class="form-control" id="role" value="<?php echo $model->getName() ?>" name="role">
    </div>
    <br>
    <button type="submit" class="btn btn-outline-success">Сохранить</button>
</form>