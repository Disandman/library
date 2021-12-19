<?php

use App\core\Breadcrumb;

Breadcrumb::add('/group/index', 'Группы');
Breadcrumb::add_current('/group/create', 'Добавление группы');

?>

<div class="bg-light">
    <?php echo Breadcrumb::out(); ?>
</div>

<div class="col">
    <h1>Добавление Группы</h1>
</div>
<form method="post" action="/group/create">
    <div class="form-group">
        <label for="group">Группа: </label>
        <input type="text" class="form-control" id="group" name="group">
    </div>
    <br>
    <button type="submit" class="btn btn-outline-success">Создать</button>
</form>