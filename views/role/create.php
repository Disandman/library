<div class="bg-light">
    <?php
    \App\core\Breadcrumb::add('/user/index', 'Роли');
    \App\core\Breadcrumb::add_current('/role/create', 'Добавление роли');
    echo \App\core\Breadcrumb::out();

    /** @var array $model */
    /** @var array $role */
    ?>
</div>


<div class="col">
    <h1>Создание Роли</h1>
</div>


<form method="post" action="/role/create">
    <div class="form-group">
        <label for="role">Роль</label>
        <input type="text" class="form-control" id="role" name="role">
    </div>
    <br>

    <button type="submit" class="btn btn-outline-success">Создать</button>
</form>