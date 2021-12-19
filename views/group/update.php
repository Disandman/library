<div class="bg-light">
    <?php

    \App\core\Breadcrumb::add('/division/index', '');
    \App\core\Breadcrumb::add_current('/division/create', 'Изменение Группы');
    echo \App\core\Breadcrumb::out();

    /** @var array $model */
    ?>
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