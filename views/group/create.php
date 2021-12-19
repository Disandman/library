<div class="bg-light">
    <?php
    \App\core\Breadcrumb::add('/division/index', 'Группы');
    \App\core\Breadcrumb::add_current('/division/create', 'Добавление группы');
    echo \App\core\Breadcrumb::out();

    /** @var array $model */
    /** @var array $role */
    ?>
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