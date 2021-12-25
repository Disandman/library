<?php

use App\core\Breadcrumb;
use App\core\Paginator;

Breadcrumb::add_current('/user/index', 'Пользователи');

/** @var array $model */
/** @var array $role */
/** @var array $user */
/** @var array $readersTicket */
?>

    <script>
        $(function ($) {
            var storage = localStorage.getItem('nav-tabs');
            if (storage && storage !== "#") {
                $('.nav-tabs a[href="' + storage + '"]').tab('show');
            }

            $('ul.nav li').on('click', function () {
                var id = $(this).find('a').attr('href');
                localStorage.setItem('nav-tabs', id);
            });
        });
    </script>

    <div class="bg-light">
        <?php echo Breadcrumb::out(); ?>
    </div>

    <br>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#tab-1">Пользователи</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tab-2">Роли</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="tab-1">
            <table class="table table-hover">
                <thead class="thead-dark">
                <form method="get" action="/user/index">
                    <tr>
                        <th scope="col">ФИО<input type="search" class="form-control" id="full_name" name="full_name"
                                                  id="searchInput"
                                                  value="<?php echo !empty($_GET['full_name']) ? $_GET['full_name'] : '' ?>">
                        </th>
                        <th scope="col">Логин<input type="search" class="form-control" id="login" name="login"
                                                    value="<?php echo !empty($_GET['login']) ? $_GET['login'] : '' ?>">
                        </th>
                        <th scope="col">Роль<select class="form-select" name="role_user" id="role_user"
                                                    aria-label="Default select example" onchange="this.form.submit()">
                                <option value=""></option>
                                <?php foreach ($role as $roles) : ?>
                                    <option <?php if (!empty($_GET['role_user'])) echo $roles->getIdRole() == $_GET['role_user'] ? 'selected' : ''; ?>
                                            value="<?php echo $roles->getIdRole(); ?>"><?php echo $roles->getName(); ?></option>
                                <?php endforeach; ?>
                            </select></th>
                        <th scope="col">Должность<select class="form-select" name="position" id="position"
                                                         aria-label="Default select example"
                                                         onchange="this.form.submit()">
                                <option value=""></option>
                                <?php foreach ($readersTicket->getPosition() as $key => $positions): ?>
                                    <option <?php if (!empty($_GET['position'])) echo $key == $_GET['position'] ? 'selected' : ''; ?>
                                            value="<?php echo $key; ?>"><?php echo $positions; ?></option>
                                <?php endforeach; ?>
                            </select></th>
                        <th scope="col">Статус<select class="form-select" name="active" id="active"
                                                      aria-label="Default select example" onchange="this.form.submit()">
                                <option value=""></option>
                                <?php foreach ($readersTicket->getStatus() as $key => $status){ ?>
                                <option <?php if (!empty($_GET['active'])) echo $key == $_GET['active'] ? 'selected' : ''; ?>
                                        value="<?php echo $key; ?>"><?php echo $status;
                                    } ?></option>
                            </select></th>
                        <input type="submit" hidden="true"/>
                    </tr>
                </form>
                </thead>
                <?php foreach ($model as $models) : ?>
                    <tr>
                        <td align="left"><?php echo $models->getFullName(); ?></td>
                        <td align="left"><?php echo $models->getLogin(); ?></td>
                        <td align="left"><?php echo $user->getUserRole($models->getRole()) ?></td>
                        <td align="left">
                            <?php $result = $readersTicket->getIdUser($models->getIdUser());
                            echo $readersTicket->getPositionId($result->getIdPosition()); ?>
                        </td>
                        <td align="left"><?php echo $readersTicket->getUserStatus($models->getActive()) ?></td>
                        <td>
                            <a href="/user/view?id=<?php echo $models->getIdUser(); ?>"" class="btn btn-outline-info
                            btn-sm"><i class="bi bi-eye"></i></a>
                            <a href="/user/update?id=<?php echo $models->getIdUser(); ?>"
                               class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i></a>
                            <a href="/user/delete?id=<?php echo $models->getIdUser(); ?>"
                               class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <div class="col-md-2 text-right">
                <a href="/user/create" class="btn btn-success">Добавить</a>
            </div>
        </div>
        <div class="tab-pane fade" id="tab-2">
            <table class="table table-hover">
                <thead class="thead-dark">
                <form method="get" action="/user/index">
                    <tr>
                        <th scope="col">Роль<input type="search" class="form-control" id="role" name="role"
                                                   value="<?php echo !empty($_GET['role']) ? $_GET['role'] : '' ?>">
                        </th>
                        <th width="120"></th>
                    </tr>
                </form>
                </thead>
                <?php foreach ($role as $roles) : ?>
                    <tr>
                        <td align="left"><?php echo $roles->getName(); ?></td>
                        <td>
                            <a href="/role/update?id=<?php echo $roles->getIdRole(); ?>"
                               class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i></a>
                            <a href="/role/delete?id=<?php echo $roles->getIdRole(); ?>"
                               class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <div class="col-md-2 text-right">
                <a href="/role/create" class="btn btn-success">Добавить</a>
            </div>
        </div>
    </div>
<?php $paginator = new Paginator();
echo $paginator->getViewPaginator(); ?>