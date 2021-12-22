<?php

use App\core\Breadcrumb;

/** @var array $access */
/** @var array $myBook */
/** @var array $ordered */
/** @var array $lost */
/** @var array $booksModel */
/** @var object $entityManager */

if ($access->getRole('Администратор') || $access->getRole('Сотрудник библиотеки')) {
    Breadcrumb::add_current('/books-user/index', 'Книги читателя');
} else {
    Breadcrumb::add_current('/books-user/index', 'Мои книги');
}
?>

<div class="bg-light">
    <?php echo Breadcrumb::out(); ?>
</div>
<br>
<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                    type="button" role="tab" aria-controls="nav-home" aria-selected="true">На руках
            </button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Заказанные
            </button>
            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                    type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Потерянные
            </button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Книги</th>
                    <th scope="col">Дата получения</th>
                    <th scope="col">Дата сдачи</th>
                    <th width="120"></th>
                </tr>
                </thead>
                <?php foreach ($myBook as $myBooks) : ?>
                    <tr>
                        <td align="left">
                            <a href="/books/view?id=<?php echo $myBooks->getIdBooks() ?>"><?php echo $booksModel->getBooks($myBooks->getIdBooks()); ?></a>
                        </td>
                        <td align="left"><?php echo $myBooks->getDateTackingBooks(); ?></td>
                        <td align="left"><?php echo $myBooks->getDateEndTackingBooks(); ?></td>
                        <td>
                            <?php if ($access->getRole('Администратор') || $access->getRole('Сотрудник библиотеки')) { ?>
                                <a href="/books-user/refusal?id=<?php echo $myBooks->getIdConnectBooks(); ?>"
                                   class="btn btn-outline-info btn-sm">Списать</a>

                            <?php } else { ?>
                                <a href="/books-user/lost?id=<?php echo $myBooks->getIdConnectBooks(); ?>"
                                   class="btn btn-outline-danger btn-sm">Заявить о пропаже</a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Книги</th>
                    <th width="120"></th>
                </tr>
                </thead>
                <?php foreach ($ordered as $ordereds) : ?>
                    <tr>
                        <td align="left">
                            <a href="/books/view?id=<?php echo $ordereds->getIdBooks() ?>"><?php echo $booksModel->getBooks($ordereds->getIdBooks()); ?></a>
                        </td>
                        <td>
                            <?php if ($access->getRole('Администратор') || $access->getRole('Сотрудник библиотеки')) { ?>
                                <a href="/books-user/issue?id=<?php echo $ordereds->getIdConnectBooks(); ?>"
                                   class="btn btn-outline-info btn-sm">Выдать</a>

                            <?php } else { ?>
                                <a href="/books-user/refusal?id=<?php echo $ordereds->getIdConnectBooks(); ?>"
                                   class="btn btn-outline-danger btn-sm">Отказаться</a>
                            <?php } ?>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
            <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Книги</th>
                    <th scope="col">Дата пропажи</th>
                    <th scope="col">Сумма компенсации</th>
                    <?php if ($access->getRole('Администратор') || $access->getRole('Сотрудник библиотеки')) { ?>
                        <th width="120"></th>
                    <?php } ?>
                </tr>
                </thead>
                <?php foreach ($lost as $losted) : ?>
                    <tr>
                        <td align="left">
                            <a href="/books/view?id=<?php echo $losted->getIdBooks() ?>"><?php echo $booksModel->getBooks($losted->getIdBooks()); ?></a>
                        </td>
                        <td align="left"><?php echo $losted->getDateLost(); ?></td>
                        <td align="left">
                            <?php echo $booksModel->getPriceBooks($losted->getIdBooks()); ?>
                        </td>
                        <?php if ($access->getRole('Администратор')|| $access->getRole('Сотрудник библиотеки')) { ?>
                            <td align="left">
                                <a href="/books-user/lostRefusal?id=<?php echo $losted->getIdConnectBooks(); ?>"
                                   class="btn btn-outline-info btn-sm">Списать</a>
                            </td>
                        <?php } ?>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
