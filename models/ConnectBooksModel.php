<?php

namespace App\models;

use App\config\DB_connect;

/**
 * Данный клас предназначен для поиска через сущность ConnectBooks некоторых элементов в базе (книг читателей)
 */
class ConnectBooksModel
{
    const FROM_THE_READER = 1;
    const ORDERED = 0;
    const LOST = 2;

    /**
     * Статус книги (используется при отображении всех книг)
     * @var string[]
     */
    public static array $status_books= [
        self::FROM_THE_READER => 'У читателя',
        self::ORDERED => 'Заказана',
        self::LOST => 'Потеряна',
    ];


    private $access; //проверка доступа на основе роли
    private $entityManager; //создание entityManager (Doctrine);

    function __construct()
    {
        $this->access = new Access();
        $entityManagerClass = new DB_connect();
        $this->entityManager = $entityManagerClass->connect();
    }

    /**
     * Поиск всех записей в базе по сущности "КНИГИ ПОЛЬЗОВАТЕЛЯ"
     * @return array|object[]
     */
    public function getAll(): array
    {
        $connect_books_model = $this->entityManager->getRepository(':ConnectBooks');
        return $connect_books_model->findAll();
    }

    /**
     * Поиск пользователей у кого книги на руках
     * @return array|object[]
     */
    public function getBooksUser($id)
    {
        $query = $this->entityManager->getRepository(':ConnectBooks')->createQueryBuilder('p');
        $query->where('p.id_books =' . $id);//книги
        return $query->getQuery()->getResult();
    }

    /**
     * Поиск пользователей у кого книги на руках
     * @return array|object[]
     */
    public function getBooksUserStatus($id_user,$id_books)
    {
        $user_model = $this->entityManager->getRepository(':ConnectBooks');
        $users = $user_model->findOneBy(['id_user' => $id_user,'id_books' => $id_books]);
        return $users->getStatus();
    }
    /**
     * Вывод имени пользователя
     * @return array|object[]
     */
    public function getUserFullName($id)
    {
        $user_model = $this->entityManager->getRepository(':User');
        $users = $user_model->findOneBy(['id_user' => $id]);
        return $users->getFullName();
    }

    /**
     * Используется для поиска Статуса
     * @param $id
     * @return mixed|object|null
     */
    public function getStatusBooks($status)
    {
        return self::$status_books[$status];
    }


    /**
     * Поиск одной записи (уникальный идентификатор передается через GET запрос) в базе по сущности "КНИНИ ПОЛЬЗОВАТЕЛЕЙ"
     * @return mixed|object|null
     */
    public function getOne()
    {
        $connect_books_model = $this->entityManager->getRepository(':ReadersTicket');
        return $connect_books_model->findOneBy(['id_user' => $_GET['id']]);
    }

    /**
     * Выборка книг пользователя в раздел (На руках)
     * @return array|object[]
     * @throws \Exception
     */
    public function getMyBooks(): array
    {
        $query = $this->entityManager->getRepository(':ConnectBooks')->createQueryBuilder('p');//определяем сущность для создания запроса

        if ($this->access->getRole('Администратор') || $this->access->getRole('Сотрудник библиотеки')) {//проверка на роль пользователя
            if (!empty($_GET['id'])) {//если приходит GET, то в запросе используем id пользователя (только для администратора или сотрудника библиотеки)
                $id_user = $_GET['id'];//идентификатор из GET
            } else {
                $id_user = $_SESSION['id_user'];//для пользователя используем идентификатор взятый из сессии
            }
            //собираем запрос для администратора или сотрудника библиотеки
            $query->where('p.status = 1')//книги (На руках)
            ->andWhere('p.id_user =' . $id_user);
        } else {
            //собираем запрос для пользователя
            $query->where('p.status = 1')//книги (На руках)
            ->andWhere('p.id_user =' . $_SESSION['id_user']);
        }
        return $query->getQuery()->getResult();
    }

    /**
     * Выборка книг пользователя в раздел (Заказанные)
     * @return array|object[]
     * @throws \Exception
     */
    public function getOrdered(): array
    {
        $query = $this->entityManager->getRepository(':ConnectBooks')->createQueryBuilder('p');//определяем сущность для создания запроса

        if ($this->access->getRole('Администратор') || $this->access->getRole('Сотрудник библиотеки')) {//проверка на роль пользователя
            if (!empty($_GET['id'])) {//если приходит GET, то в запросе используем id пользователя (только для администратора или сотрудника библиотеки)
                $id_user = $_GET['id'];
            } else {
                $id_user = $_SESSION['id_user'];//для пользователя используем идентификатор взятый из сессии
            }
            //собираем запрос для администратора или сотрудника библиотеки
            $query->where('p.status = 0')//книги (Заказаны)
            ->andWhere('p.id_user =' . $id_user);

        } else {
            //собираем запрос для пользователя
            $query->where('p.status = 0')//книги (Заказаны)
                ->andWhere('p.id_user =' . $_SESSION['id_user']);
        }
        return $query->getQuery()->getResult();
    }

    /**
     * Выборка книг пользователя в раздел (Потерянные)
     * @return array|object[]
     * @throws \Exception
     */
    public function getLost(): array
    {
        $query = $this->entityManager->getRepository(':ConnectBooks')->createQueryBuilder('p');//определяем сущность для создания запроса

        if ($this->access->getRole('Администратор') || $this->access->getRole('Сотрудник библиотеки')) {//проверка на роль пользователя
            if (!empty($_GET['id'])) {//если приходит GET, то в запросе используем id пользователя (только для администратора или сотрудника библиотеки)
                $id_user = $_GET['id'];
            } else {
                $id_user = $_SESSION['id_user'];//для пользователя используем идентификатор взятый из сессии
            }
            //собираем запрос для администратора или сотрудника библиотеки
            $query->where('p.status = 2')//книги (Потеряны)
            ->andWhere('p.id_user =' . $id_user);

        } else {
            //собираем запрос для пользователя
            $query->where('p.status = 2')//книги (Потеряны)
                ->andWhere('p.id_user =' . $_SESSION['id_user']);
        }
        return $query->getQuery()->getResult();
    }

    /**
     * Вывод всех книг кроме (утерянных и списанных)
     * @param $books
     * @return int|mixed|string
     */
    public function getAvailability($books)
    {
        $query = $this->entityManager->getRepository(':ConnectBooks')->createQueryBuilder('p');
        $query->where('p.id_user = ' . $_SESSION['id_user'])->andWhere('p.id_books = ' . $books)->andWhere('p.status = 0 OR p.status = 1 OR p.status = 2');

        return $query->getQuery()->getResult();
    }

    /**
     * Поиск читательского билета для редирект на страницу с книгами читателя
     * @param $id
     * @return mixed|object|null
     */
    public function getIdUser($id)
    {
        $userRepository = $this->entityManager->getRepository(':ReadersTicket');
        return $userRepository->findOneBy(['id_user' => $id]);
    }
    /**
     * Поиск читательского билета для редирект на страницу с книгами читателя
     * @param $id
     * @return mixed|object|null
     */
    public function getUserName($id)
    {
        $userRepository = $this->entityManager->getRepository(':ReadersTicket');
        $findUser = $userRepository->findOneBy(['id_user' => $id]);
        return $findUser->getFullName();
    }

    /**
     * Вывод названия книги
     * @param $id
     * @return mixed|object|null
     */
    public function getBooks($id)
    {
        $userRepository = $this->entityManager->getRepository(':Books');
        $findBooks = $userRepository->findOneBy(['id_books' => $id]);
        return $findBooks->getNameBooks();
    }

    /**
     * Вывод цены книги
     * @param $id
     * @return mixed
     */
    public function getPriceBooks($id)
    {
        $userRepository = $this->entityManager->getRepository(':Books');
        $findBooks = $userRepository->findOneBy(['id_books' => $id]);
        return $findBooks->getPriceBooks();
    }

    public function getLostBooksUser(){
        $sumBooks = 0;
        foreach ($this->getLost() as $losted) {
            $books []= $this->getBooks($losted->getIdBooks()) . ' - ' . $this->getPriceBooks($losted->getIdBooks()) . ' ₽ <br>';
            $sumBooks += $this->getPriceBooks($losted->getIdBooks());
        }
        return [$books,$sumBooks];
    }

    public function getViolationUser(){
        $connectViolation = new ConnectViolationModel();
        $resultConnectViolation = $connectViolation->getBlock();

        $sumViolation = 0;
        foreach ($resultConnectViolation as $resultConnectViolations) {
            $violation [] =  $connectViolation->getViolationName($resultConnectViolations->getIdViolation()) . ' - ' . $connectViolation->getViolationPrice($resultConnectViolations->getIdViolation()) . ' ₽ <br>';
            $sumViolation += $connectViolation->getViolationPrice($resultConnectViolations->getIdViolation());
        }
        return [$violation,$sumViolation];
    }

}