<div class="bg-light">
    <?php
    \App\core\Breadcrumb::add('/user/index', 'Пользователи');
    \App\core\Breadcrumb::add_current('/user/create', 'Добавление пользователя');
    echo \App\core\Breadcrumb::out();

    /** @var array $model */
    /** @var array $role */
    /** @var array $division */
    /** @var array $group */
    ?>
</div>

<div class="col">
    <h1>Создание пользователя</h1>
</div>

<form method="post" action="/user/create">
    <div class="form-group">
        <label for="full_name">ФИО</label>
        <input type="text" class="form-control" id="full_name" name="full_name">
    </div>
    <br>

    <div class="form-group">
        <label for="division">Подразделение</label>
        <select class="form-control" id="division" name="division">
            <?php foreach ($division as $divisions) : ?>
                <option value="<?php echo $divisions->getIdDivision(); ?>"><?php echo $divisions->getDivision();?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <br>
    <div class="form-group">
        <label for="course">Курс</label>
        <select class="form-control" id="course" name="course">
            <?php  foreach (\App\models\ReadersTicketModel::$course as $key =>$courses){ ?>
            <option value="<?php echo $key;?>"><?php echo $courses; }?></option>
        </select>
    </div>
    <br>
    <div class="form-group">
        <label for="group">Группа</label>
        <select class="form-control" id="division" name="group">
            <?php foreach ($group as $groups) : ?>
                <option value="<?php echo $groups->getIdGroup(); ?>"><?php echo $groups->getGroupName();?></option>
            <?php endforeach; ?>

        </select>
    </div>
    <br>
    <div class="form-group">
        <label for="login">Логин</label>
        <input type="text" class="form-control" id="login" name="login">
    </div>
    <br>
    <div class="form-group">
        <label for="password">Пароль</label>
        <input type="password" class="form-control" id="exampleInputPassword" name="password">
    </div>
    <br>
    <div class="form-group">
        <label for="exampleFormControlStatus">Статус</label>
        <select class="form-control" id="status" name="status">
            <?php foreach (\App\models\UserModels::$status as $key => $statuses){ ?>
            <option value="<?php echo $key;?>"><?php echo $statuses;}?></option>
        </select>
    </div>
    <br>
    <div class="form-group">
        <label for="exampleFormControlRole">Роль</label>
        <select class="form-control" id="exampleFormControlRole" name="role">

            <?php foreach ($role as $roles) : ?>
                <option value="<?php echo $roles->getIdRole(); ?>"><?php echo $roles->getName(); ?></option>
            <?php endforeach; ?>

        </select>
    </div>
    <br>
    <button type="submit" class="btn btn-outline-success">Создать</button>
</form>