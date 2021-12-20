<?php

use App\core\Breadcrumb;

Breadcrumb::add_current('/books/index', 'Книги');

/** @var array $model */
/** @var array $access */
/** @var array $connectBooks */
/** @var array $readersTicket */
?>

<div class="bg-light">
    <?php echo Breadcrumb::out(); ?>
</div>
<br>
<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Название</th>
            <th scope="col">Автор</th>
            <th scope="col">Дата публикации</th>
            <th scope="col">У читателей</th>
            <th width="120"></th>
        </tr>
        </thead>
        <?php foreach ($model as $models) : ?>
            <tr>
                <td align="left"><a
                            href="/books/view?id=<?php echo $models->getIdBooks() ?>"><?php echo $models->getNameBooks(); ?></a>
                </td>
                <td align="left"><?php echo $models->getAuthor(); ?></td>
                <td align="left"><?php echo $models->getDatePublication(); ?></td>
                <td align="left"><?php
                    foreach ($connectBooks->getBooksUser($models->getIdBooks()) as $user) {
                        echo '<a href="/books-user/index?id=' . $user->getIdUser() . '">' . $connectBooks->getUserFullName($user->getIdUser()) . '<span class="badge bg-light text-dark">'.$connectBooks->getStatusBooks($connectBooks->getBooksUserStatus($user->getIdUser(),$models->getIdBooks())).'</span></a><br>';
                    } ?>
                </td>
                <td>
                    <?php if ($access->getRole('Администратор') || $access->getRole('Сотрудник библиотеки')) { ?>
                        <a href="/books/view?id=<?php echo $models->getIdBooks(); ?>"" class="btn btn-outline-info btn-sm">
                        <i class="bi bi-eye"></i></a>
                        <a href="/books/update?id=<?php echo $models->getIdBooks(); ?>"
                           class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i></a>
                        <a href="/books/delete?id=<?php echo $models->getIdBooks(); ?>"
                           class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></a>
                        <?php
                    } else {
                        $readersTicketBlock = $readersTicket->getOneUser();
                        $books = $connectBooks->getAvailability($models->getIdBooks());
                        if (empty($readersTicketBlock)) {
                            if (!empty($books)) {
                                echo ' <a class="btn btn-success btn-sm">Добавлена в Ваши книги</a>';
                            } else echo '<a href="/books-user/add?id=' . $models->getIdBooks() . ' "class="btn btn-outline-info btn-sm">Получить книгу</a>';
                        } else echo '<a href="/books-user/index" class="btn btn-danger btn-sm">Вы заблокированы</a>';
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php if ($access->getRole('Администратор') || $access->getRole('Сотрудник библиотеки')) : ?>
        <div class="col-md-2 text-right">
            <a href="/books/create" class="btn btn-success">Добавить</a>
        </div>
    <?php endif; ?>
