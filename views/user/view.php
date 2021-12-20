<?php

use App\core\Breadcrumb;

Breadcrumb::add('/user/index', 'Пользователи');
Breadcrumb::add_current('/user/view', 'Просмотр пользователя');

/** @var array $model */
/** @var array $user */
/** @var array $readersTicketModel */
/** @var array $readersTicket */
/** @var array $academicInfo */
/** @var object $resultAcademicInfo */
?>

<div class="bg-light">
    <?php echo Breadcrumb::out(); ?>
</div>

<div class="card">
    <table class="table table-hover">
        <tr>
            <th scope="col">id</th>
            <td align="left"><?php echo $model->getIdUser(); ?></td>
        </tr>
        <tr>
            <th scope="col">ФИО</th>
            <td align="left"><?php echo $model->getFullName(); ?></td>
        </tr>
        <tr>
            <th scope="col">Логин</th>
            <td align="left"><?php echo $model->getLogin(); ?></td>
        </tr>
        <tr>
            <th scope="col">Роль</th>
            <td align="left">
                <?php echo $user->getUserRole($model->getRole())?>
            </td>
        </tr>
        <tr>
            <th scope="col">Подразделение</th>
            <td align="left">
                <?php echo $readersTicket->getIdDivision() !== null ? $readersTicketModel->getUserDivision($readersTicket->getIdDivision()) : '-'; ?>
            </td>
        </tr>
        <tr>
            <th scope="col">Должность</th>
            <td align="left">
                <?php echo $readersTicketModel->getPositionId($readersTicket->getIdPosition()); ?>
            </td>
        </tr>
        <?php if ($resultAcademicInfo !== null) : ?>
            <tr>
                <th scope="col">Научная степень</th>
                <td align="left">
                    <?php echo $academicInfo->getAcademicTitle($resultAcademicInfo->getIdAcademicTitle())?>
                </td>
            </tr>
        <?php endif; ?>
        <?php if ($resultAcademicInfo !== null) : ?>
            <tr>
                <th scope="col">Научное звание</th>
                <td align="left">
                    <?php echo $academicInfo->getAcademicDegree($resultAcademicInfo->getIdAcademicDegree())?>
                </td>
            </tr>
        <?php endif; ?>
        <?php if (!empty($readersTicket->getIdCourse())) : ?>
            <tr>
                <th scope="col">Курс</th>
                <td align="left">
                    <?php echo $readersTicketModel->getUserCourse($readersTicket->getIdCourse())?>
                </td>
            </tr>
        <?php endif; ?>
        <?php if (!empty($readersTicket->getIdGroup())) : ?>
            <tr>
                <th scope="col">Группа</th>
                <td align="left">
                    <?php echo$readersTicketModel->getUserGroup($readersTicket->getIdGroup())?>
                </td>
            </tr>
        <?php endif; ?>
        <tr>
            <th scope="col">Статус</th>
            <td align="left"><?php echo $readersTicketModel->getUserStatus($model->getActive())?></td>
        </tr>
    </table>
    <div class="container text-center">
        <a href="/user/index" class="btn btn-outline-info">Назад</a>
        <a href="/user/update?id=<?php echo $model->getIdUser(); ?>" class="btn btn-outline-primary">Изменить</a>
    </div>
</div>









