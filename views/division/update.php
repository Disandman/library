<div class="bg-light">
    <?php

    \App\core\Breadcrumb::add('/division/index', 'Подразделения');
    \App\core\Breadcrumb::add_current('/division/create', 'Изменение подразделения');
    echo \App\core\Breadcrumb::out();

    /** @var array $model */
    ?>
</div>


<div class="col">
    <h1>Изменение: <?php echo $model->getDivision() ?></h1>
</div>

<form method="post" action="/division/update?id=<?php echo $model->getIdDivision(); ?>">


    <div class="form-group">
        <label for="division">Подразделение</label>
        <input type="text" class="form-control" id="division" value="<?php echo $model->getDivision() ?>" name="division">
    </div>

    <br>
    <button type="submit" class="btn btn-outline-success">Сохранить</button>
</form>