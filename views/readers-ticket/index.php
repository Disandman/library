<?php

use App\core\Breadcrumb;
use App\core\Paginator;

Breadcrumb::add_current('/readers-ticket/index', 'Читатели');

/** @var array $model */
/** @var string $userName */
/** @var string $readersTicket */
?>

<div class="bg-light">
    <?php echo Breadcrumb::out(); ?>
</div>
<br>
<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <table class="table table-hover">
        <thead class="thead-dark">
        <form method="get" action="/readers-ticket/index">
        <tr>
            <th scope="col">ФИО<input type="search" class="form-control" id="full_name" name="full_name"
                                      value="<?php echo !empty($_GET['full_name']) ? $_GET['full_name'] : '' ?>">
            </th>
            <th scope="col">Подразделение<input type="search" class="form-control" id="division" name="division"
                                                value="<?php echo !empty($_GET['division']) ? $_GET['division'] : '' ?>">
            </th>
            <th scope="col">Должность<select class="form-select" name="position" id="position"
                                             aria-label="Default select example" onchange="this.form.submit()">
                    <option value=""></option>
                    <?php foreach ($readersTicket->getPosition() as $key => $positions): ?>
                        <option <?php if (!empty($_GET['position'])) echo $key == $_GET['position'] ? 'selected' : ''; ?>
                                value="<?php echo $key; ?>"><?php echo $positions; ?></option>
                    <?php endforeach; ?>
                </select></th>
            <th scope="col">Курс<select class="form-select" name="course" id="course"
                                        aria-label="Default select example" onchange="this.form.submit()">
                    <option value=""></option>
                    <?php foreach ($readersTicket->getCource() as $key => $course): ?>
                        <option <?php if (!empty($_GET['course'])) echo $key == $_GET['course'] ? 'selected' : ''; ?>
                                value="<?php echo $key; ?>"><?php echo $course; ?></option>
                    <?php endforeach; ?>
                </select></th>
            <th scope="col">Группа<input type="search" class="form-control" id="group" name="group"
                                         value="<?php echo !empty($_GET['group']) ? $_GET['group'] : '' ?>"></th>
            <th scope="col">Статус<select class="form-select" name="block" id="block"
                                          aria-label="Default select example" onchange="this.form.submit()">
                    <option value=""></option>
                    <?php foreach ($readersTicket->getStatus() as $key => $status): ?>
                        <option <?php if (!empty($_GET['block'])) echo $key == $_GET['block'] ? 'selected' : ''; ?>
                                value="<?php echo $key; ?>"><?php echo $status; ?></option>
                    <?php endforeach; ?>
                </select></th>
            <th scope="col">Дата блокировки<input type="date" class="form-control" placeholder="Найти по дате блокировке..."
                                                  id="date_blocking" name="date_blocking"
                                                  value="<?php echo !empty($_GET['date_blocking']) ? $_GET['date_blocking'] : '' ?>">
            </th>
            <th scope="col">Дата разблокировки<input type="date" class="form-control" placeholder="Найти по дате разблокировке..."
                                                     id="date_unblocking" name="date_unblocking"
                                                     value="<?php echo !empty($_GET['date_unblocking']) ? $_GET['date_unblocking'] : '' ?>">
            </th>
            <th width="120"></th>
            <input type="submit" hidden="true"/>
        </tr>
        </form>
        </thead>
        <?php foreach ($model as $models) : ?>
            <tr>
                <td align="left">
                    <a href="/user/view?id=<?php echo $models->getIdUser() ?>"><?php echo $readersTicket->getUserName($models->getIdUser()) ?></a>
                </td>
                <td align="left"><?php echo !empty($models->getIdDivision()) ? $readersTicket->getUserDivision($models->getIdDivision()) : '' ?></td>
                <td align="left"><?php echo !empty($models->getIdPosition()) ? $readersTicket->getPositionId($models->getIdPosition()) : '' ?></td>
                <td align="left"><?php echo !empty($models->getIdCourse()) ? $readersTicket->getUserCourse($models->getIdCourse()) : '' ?></td>
                <td align="left"><?php echo !empty($models->getIdGroup()) ? $readersTicket->getUserGroup($models->getIdGroup()) : '' ?></td>
                <td align="left"><?php echo $models->getBlock() == 0 ? '<a href="/books-user/blockAdmin?id=' . $models->getIdUser() . '" class="btn btn-outline-warning btn-sm">Заблоктрован</button>' : $readersTicket->getUserStatus($models->getBlock()) ?></td>
                <td align="left"><?php echo $models->getDateBlocking(); ?></td>
                <td align="left"><?php echo $models->getDateUnblocking(); ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="/books-user/index?id=<?php echo $readersTicket->getUserId($models->getIdUser()) ?>"
                           class="btn btn-outline-primary btn-sm">Книги читателя</a>
                        <a href="/readers-ticket/block?id=<?php echo $models->getIdReadersTicket(); ?>"
                        <?php echo $models->getBlock() == 0 ? 'class="btn btn-danger btn-sm"><i class="bi bi-lock"></i> </a>' : 'class="btn btn-success btn-sm"><i class="bi bi-unlock"></i> </a>'; ?>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php $paginator = new Paginator();
echo $paginator->getViewPaginator(); ?>