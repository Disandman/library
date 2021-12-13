<div class="bg-light">
    <?php

    use App\config\DB_connect;

    \App\core\Breadcrumb::add('/user/index', 'Пользователи');
    \App\core\Breadcrumb::add_current('/user/create', 'Изменение пользователя');
    echo \App\core\Breadcrumb::out();

    $entityManagerClass = new DB_connect();
    $entityManager = $entityManagerClass->connect();

    /** @var array $model */
    /** @var array $role */
    /** @var array $division */
    /** @var array $readersTicket */
    /** @var array $group */
    ?>
</div>


<div class="col">
    <h1>Изменение: <?php echo $model->getLogin() ?></h1>
</div>


<form method="post" action="/user/update?id=<?php echo $model->getIdUser() ?>">


    <div class="form-group">
        <label for="full_name">ФИО</label>
        <input type="text" class="form-control" id="full_name" value="<?php echo $model->getFullName() ?>"
               name="full_name">
    </div>
    <br>
    <div class="form-group">
        <label for="division">Подразделение</label>
        <select class="form-control" id="division" name="division">
            <?php foreach ($division as $divisions) :
                foreach ($readersTicket as $readersTickets) :?>
                <option <?php echo  $divisions->getIdDivision() == $entityManager->getRepository(':Division')->find($readersTickets->getIdDivision())->getIdDivision() ? 'selected' : ''; ?> value="<?php echo $divisions->getIdDivision(); ?>"><?php echo $divisions->getDivision();?></option>
            <?php endforeach;
            endforeach;?>
        </select>
    </div>
    <br>
    <div class="form-group">
        <label for="course">Курс</label>
        <select class="form-control" id="course" name="course">
            <?php  foreach (\App\models\ReadersTicketModel::$course as $key =>$courses):
            foreach ($readersTicket as $readersTickets) :?>
            <option <?php echo $key == $readersTickets->getIdCourse() ? 'selected' : '';?> value="<?php echo $key;?>"><?php echo $courses;?></option>
            <?php endforeach;
            endforeach;?>
        </select>
    </div>
    <br>
    <div class="form-group">
        <label for="group">Группа</label>
        <select class="form-control" id="division" name="group">
            <?php foreach ($group as $groups) :
            foreach ($readersTicket as $readersTickets) :?>
                <option <?php echo $groups->getIdGroup() == $entityManager->getRepository(':Group')->find($readersTickets->getIdGroup())->getIdGroup() ? 'selected' : ''; ?> value="<?php echo $groups->getIdGroup(); ?>"><?php echo $groups->getGroupName();?></option>
            <?php endforeach;
            endforeach;?>

        </select>
    </div>
    <br>
    <div class="form-group">
        <label for="login">Логин</label>
        <input type="text" class="form-control" value="<?php echo $model->getLogin() ?>" id="login" name="login">
    </div>
    <br>
    <div class="form-group">
        <label for="password">Новый пароль</label>
        <input type="password" class="form-control" id="exampleInputPassword" name="password">
    </div>
    <br>
    <div class="form-group">
        <label for="exampleFormControlStatus">Статус</label>
        <select class="form-control" id="exampleFormControlStatus" name="status">
            <?php foreach (\App\models\UserModels::$status as $key => $statuses){ ?>
            <option value="<?php echo $key;?>"><?php echo $statuses;}?></option>
        </select>
    </div>
    <br>
    <div class="form-group">
        <label for="exampleFormControlRole">Роль</label>
        <select class="form-control" id="exampleFormControlRole" name="role">

            <?php foreach ($role as $roles) : ?>
                <option <?php echo  $roles->getIdrole() == $entityManager->getRepository(':Role')->find($model->getRole())->getIdRole() ? 'selected' : ''; ?> value="<?php echo $roles->getIdRole(); ?>"><?php echo $roles->getName(); ?></option>
            <?php endforeach; ?>

        </select>
    </div>

<!--    --><?php //echo $entityManager->getRepository(':Role')->find($model->getRole())->getIdRole()?>
    <br>
    <button type="submit" class="btn btn-outline-success">Сохранить</button>
</form>