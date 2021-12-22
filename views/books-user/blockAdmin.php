<?php

use App\core\Breadcrumb;

Breadcrumb::add_current('', 'Нарушения пользователя');
?>

<div class="bg-light">
    <?php echo Breadcrumb::out(); ?>
</div>
<br>
<div class="error-main">
    <div class="card">
        <?php if (!empty($lost)) : ?>
            <h4>Потерянные книги: </h4>
            <?php
            foreach ($booksModel->getLostBooksUser()[0] as $books) {
                echo $books;
            }
            $sumBooks = $booksModel->getLostBooksUser()[1];//сумма потерянных книг
            ?>
            <hr>
        <?php else:{//если потерянных книг не найдено, но применено нарушение
            $sumBooks = 0;
        }
        endif;
        ?>
        <?php if (!empty($resultConnectViolation)) : ?>
            <h4>Нарушения:</h4>
            <?php
            foreach ($booksModel->getViolationUser()[0] as $violation) {
                echo $violation;
            }
            $sumViolation = $booksModel->getViolationUser()[1];//сумма нарушений
            ?>
            <hr>
        <?php else:{//если нарушений не найдено, но есть потерянные книги
            $sumViolation = 0;
        }
        endif;
        ?>
        <h3>Сумма для компенсации нарушений: <?php echo ($sumBooks + $sumViolation) . ' ₽' ?></h3>
    </div>
    <br>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Разблокировать
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    Вы точно хотите списать все нарушения с читателя и разблокировать его?
                </div>
                <div class="modal-footer text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col text-center">
                                <a href="/readers-ticket/unblock?id=<?php echo $_GET['id'] ?>" type="button" class="btn btn-success">Да</a>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Нет</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



