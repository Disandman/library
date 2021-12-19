<div class="bg-light">
    <?php
    \App\core\Breadcrumb::add('/division/index', 'Подразделения');
    \App\core\Breadcrumb::add_current('/division/create', 'Добавление подразделения');
    echo \App\core\Breadcrumb::out();

    /** @var array $model */
    /** @var array $role */
    ?>
</div>


<div class="col">
    <h1>Добавление Подразделения</h1>
</div>

<form method="post" action="/division/create">
    <div class="form-group">
        <label for="division">Подразделение: </label>
        <input type="text" class="form-control" id="division" name="division">
    </div>
    <br>
    <button type="submit" class="btn btn-outline-success">Создать</button>
</form>