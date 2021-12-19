<div class="bg-light">
    <?php

    use App\config\DB_connect;
    use App\models\ReadersTicketModel;

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
    /** @var array $academicTitle */
    /** @var array $academicDegree */
    /** @var array $resultAcademicInfo */
    ?>
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
            <?php foreach ($division as $divisions) :?>
                    <option value="" disabled hidden>Выберите подразделение...</option>
                <option <?php echo  $divisions->getIdDivision() == $readersTicket->getIdDivision() ? 'selected' : ''; ?> value="<?php echo $divisions->getIdDivision(); ?>"><?php echo $divisions->getDivision();?></option>
            <?php endforeach;?>
        </select>
    </div>
    <br>
    <div class="form-group">
        <label for="position">Должность</label>
        <select class="form-control" id="position" name="position">
            <?php foreach (ReadersTicketModel::$position as $key =>$positions):?>
                <option value="" disabled hidden>Выберите должность...</option>
            <option <?php echo $key == $readersTicket->getIdPosition() ? 'selected' : '';?> value="<?php echo $key;?>"><?php echo $positions;?></option>
            <?php endforeach;?>
        </select>
    </div>
    <br>
    <div id="2" class="choice" <?php if (empty($resultAcademicInfo)) echo 'style="display:none;"'?>>
    <div class="form-group">
        <label for="title">Научное звание</label>
        <select class="form-control" id="title" name="title">
            <?php foreach ($academicTitle as $academicTitles) :?>
                    <option value="" disabled <?php if (empty($resultAcademicInfo)) echo 'selected'?> hidden>Выберите научное звание...</option>
                    <option <?php if (!empty($resultAcademicInfo)) echo $academicTitles->getIdAcademicTitle() == $resultAcademicInfo->getIdAcademicTitle() ? 'selected' : ''; ?> value="<?php echo $academicTitles->getIdAcademicTitle(); ?>"><?php echo $academicTitles->getName();?></option>
                <?php endforeach;?>
        </select>
    </div>
    <br>

    <div class="form-group">
        <label for="degree">Научная степень</label>
        <select class="form-control" id="degree" name="degree">
            <?php foreach ($academicDegree as $academicDegrees) : ?>
                    <option value="" disabled <?php if (empty($resultAcademicInfo)) echo 'selected'?> hidden>Выберите научную степень...</option>
                    <option <?php if (!empty($resultAcademicInfo)) echo  $academicDegrees->getIdAcademicDegree() == $resultAcademicInfo->getIdAcademicDegree() ? 'selected' : ''; ?> value="<?php echo $academicDegrees->getIdAcademicDegree(); ?>"><?php echo $academicDegrees->getName();?></option>
                <?php endforeach;?>
        </select>
    </div>
    <br>
    </div>
    <div id="1" class="choice" <?php if (empty($readersTicket->getIdCourse() || $readersTicket->getIdGroup())) echo 'style="display:none;"'?>>
    <div class="form-group">
        <label for="course">Курс</label>
        <select class="form-control" id="course" name="course">
            <?php  foreach (\App\models\ReadersTicketModel::$course as $key =>$courses):?>
                    <option value="" disabled <?php if (empty($readersTicket->getIdCourse())) echo 'selected'?> hidden>Выберите курс...</option>
                    <option <?php if (!empty($readersTicket->getIdCourse())) echo $key == $readersTicket->getIdCourse() ? 'selected' : '';?> value="<?php echo $key;?>"><?php echo $courses;?></option>
                <?php endforeach;?>
        </select>
    </div>
    <br>
    <div class="form-group">
        <label for="group">Группа</label>
        <select class="form-control" id="division" name="group">
            <?php foreach ($group as $groups) : ?>
                <option value="" disabled <?php if (empty($readersTicket->getIdGroup())) echo 'selected'?> hidden>Выберите группу...</option>
                <option <?php if (!empty($readersTicket->getIdGroup())) echo $groups->getIdGroup() == $readersTicket->getIdGroup() ? 'selected' : ''; ?> value="<?php echo $groups->getIdGroup(); ?>"><?php echo $groups->getGroupName();?></option>
            <?php endforeach;?>
        </select>
    </div>
    <br>
    </div>
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
    <br>
    <button type="submit" class="btn btn-outline-success">Сохранить</button>
</form>