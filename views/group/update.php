<?php

use App\core\Breadcrumb;

Breadcrumb::add('/group/index', 'Группы');
Breadcrumb::add_current('/group/create', 'Изменение Группы');

/** @var array $model */
?>

<div class="bg-light">
    <?php echo Breadcrumb::out(); ?>
</div>

<div class="col">
    <h1>Изменение: <?php echo $model->getGroupName() ?></h1>
</div>
<form method="post" action="/group/update?id=<?php echo $model->getIdGroup(); ?>">
    <div class="form-group">
        <label for="group">Группа:</label>
        <input type="text" class="form-control" id="group" value="<?php echo $model->getGroupName() ?>" name="group">
    </div>
    <br>
    <button type="submit" class="btn btn-outline-success">Сохранить</button>
</form>