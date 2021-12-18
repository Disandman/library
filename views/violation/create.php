<div class="bg-light">
    <?php
    \App\core\Breadcrumb::add('/division/index', 'Нарушения');
    \App\core\Breadcrumb::add_current('/division/create', 'Добавление нарушения');
    echo \App\core\Breadcrumb::out();

    /** @var array $model */
    /** @var array $role */
    ?>
</div>


<div class="col">
    <h1>Добавление Группы</h1>
</div>

<form method="post" action="/violation/create">
    <div class="form-group">
        <label for="name">Нарушение: </label>
        <input type="text" class="form-control" id="name" name="name">
        <br>
        <label for="price">Сумма: </label>
        <input type="text" class="form-control" id="price" name="price">
    </div>
    <br>
    <button type="submit" class="btn btn-outline-success">Создать</button>
</form>