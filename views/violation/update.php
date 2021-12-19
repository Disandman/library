<div class="bg-light">
    <?php

    \App\core\Breadcrumb::add('/division/index', '');
    \App\core\Breadcrumb::add_current('/division/create', 'Изменение Группы');
    echo \App\core\Breadcrumb::out();

    /** @var array $model */
    ?>
</div>


<div class="col">
    <h1>Изменение: <?php echo $model->getNameViolations() ?></h1>
</div>

<form method="post" action="/violation/update?id=<?php echo $model->getIdViolation(); ?>">


    <div class="form-group">
        <label for="name">Нарушение:</label>
        <input type="text" class="form-control" id="name" value="<?php echo $model->getNameViolations() ?>" name="name">
        <label for="price">Сумма:</label>
        <input type="text" class="form-control" id="price" value="<?php echo $model->getPriceViolations() ?>" name="price">
    </div>

    <br>
    <button type="submit" class="btn btn-outline-success">Сохранить</button>
</form>