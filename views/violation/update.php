<?php

use App\core\Breadcrumb;

Breadcrumb::add('/violation/index', 'Нарушения');
Breadcrumb::add_current('/violation/create', 'Изменение нарушения');

/** @var array $model */
?>

<div class="bg-light">
    <?php echo Breadcrumb::out(); ?>
</div>

<div class="col">
    <h1>Изменение: <?php echo $model->getNameViolations() ?></h1>
</div>
<form method="post" action="/violation/update?id=<?php echo $model->getIdViolation(); ?>">
    <div class="form-group">
        <label for="name">Нарушение:</label>
        <input type="text" class="form-control" id="name" value="<?php echo $model->getNameViolations() ?>" name="name">
        <label for="price">Сумма:</label>
        <input type="text" class="form-control" id="price" value="<?php echo $model->getPriceViolations() ?>"
               name="price">
    </div>
    <br>
    <button type="submit" class="btn btn-outline-success">Сохранить</button>
</form>