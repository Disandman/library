<?php

use App\core\Breadcrumb;

Breadcrumb::add('/user/index', 'Пользователи');
Breadcrumb::add_current('/user/create', 'Добавление пользователя');

/** @var array $model */
/** @var array $role */
/** @var array $division */
/** @var array $group */
/** @var array $academicDegree */
/** @var array $academicTitle */
/** @var array $readersTicketModel */
?>

<div class="bg-light">
    <?php echo Breadcrumb::out(); ?>
</div>

<script>
    $(document).ready(function () {
        $('#position').on('change', function () {
            var demovalue = $(this).val();
            $("div.choice").hide();
            $("#" + demovalue).show();
        });
    });
</script>

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
                <option disabled selected hidden>Выберите подразделение...</option>
                <option value="<?php echo $divisions->getIdDivision(); ?>"><?php echo $divisions->getDivision(); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <br>
    <div class="form-group">
        <label for="position">Должность</label>
        <select class="form-control" id="position" name="position" required>
            <?php foreach ($readersTicketModel->getPosition() as $key => $position){ ?>
            <option disabled selected hidden>Выберите должность...</option>
            <option value="<?php echo $key; ?>"><?php echo $position;
                } ?></option>
        </select>
    </div>
    <div id="2" class="choice" style="display:none;">
        <br>
        <div class="form-group">
            <label for="title">Научное звание</label>
            <select class="form-control" id="title" name="title">
                <?php foreach ($academicTitle as $academicTitles) : ?>
                    <option value="" disabled selected hidden>Выберите научное звание...</option>
                    <option value="<?php echo $academicTitles->getIdAcademicTitle(); ?>"><?php echo $academicTitles->getName(); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <br>
        <div class="form-group">
            <label for="degree">Научная степень</label>
            <select class="form-control" id="degree" name="degree">
                <?php foreach ($academicDegree as $academicDegrees) : ?>
                    <option value="" disabled selected hidden>Выберите научную степень...</option>
                    <option value="<?php echo $academicDegrees->getIdAcademicDegree(); ?>"><?php echo $academicDegrees->getName(); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <br>
    <div id="1" class="choice" style="display:none;">
        <div class="form-group">
            <label for="course">Курс</label>
            <select class="form-control" id="course" name="course">
                <?php foreach ($readersTicketModel->getCource() as $key => $courses){ ?>
                <option value="" disabled selected hidden>Выберите курс...</option>
                <option value="<?php echo $key; ?>"><?php echo $courses;
                    } ?></option>
            </select>
        </div>
        <br>
        <div class="form-group">
            <label for="group">Группа</label>
            <select class="form-control" id="division" name="group">
                <?php foreach ($group as $groups) : ?>
                    <option value="" disabled selected hidden>Выберите группу...</option>
                    <option value="<?php echo $groups->getIdGroup(); ?>"><?php echo $groups->getGroupName(); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <br>
    </div>
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
            <?php foreach ($readersTicketModel->getStatus() as $key => $statuses){ ?>
            <option value="<?php echo $key; ?>"><?php echo $statuses;
                } ?></option>
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
