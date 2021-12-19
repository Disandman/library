<?php

namespace App\controllers;

use App\config\DB_connect;
use App\core\View;
use App\models\AcademicDegreeModel;
use App\models\AcademicTitleModel;
use App\models\ConnectAcademicInfo;
use App\models\ConnectAcademicInfoModel;
use App\models\DivisionModel;
use App\models\GroupModel;
use App\models\ReadersTicket;
use App\models\ReadersTicketModel;
use App\models\RoleModel;
use App\models\User;
use App\models\UserModels;
use Exception;
use App\models\Access;

/**
 * Контроллер управления пользователями
 */
class UserController
{
    private Access $access; //проверка доступа на основе роли
    private \Doctrine\ORM\EntityManager $entityManager; //создание entityManager (Doctrine);

    function __construct()
    {
        $this->access = new Access();
        $entityManagerClass = new DB_connect();
        $this->entityManager = $entityManagerClass->connect();
    }

    /**
     * Вывод пользователей
     * @return void
     * @throws Exception
     */
    public function index()
    {
        $role = new RoleModel();
        $user = new UserModels();
        $readersTicket = new ReadersTicketModel();

        $resultUser = $user->getAll();
        $resultRole = $role->getAll();

        $model = [
            'model' => $resultUser,
            'role' => $resultRole,
            'readersTicket' => $readersTicket,
            'user' => $user
        ];

        if ($this->access->getRole('Администратор')) {
            View::render('Пользователи', 'user/index.php', $model);
        } else {
            View::render('Ошибка доступа', '/layouts/error_403.php');
        }
    }

    /**
     * Просмотр пользователя
     * @throws Exception
     */
    public function view()
    {

        $role = new RoleModel();
        $user = new UserModels();
        $readersTicket = new ReadersTicketModel();
        $academicInfo = new ConnectAcademicInfoModel();

        $resultUser = $user->getOne();
        $resultRole = $role->getAll();
        $resultReadersTicket = $readersTicket->getOne();
        $resultAcademicInfo = $academicInfo->getOne();

        $model = [
            'model' => $resultUser,
            'role' => $resultRole,
            'readersTicket' => $resultReadersTicket,
            'resultAcademicInfo' => $resultAcademicInfo,
            'user' => $user,
            'readersTicketModel' => $readersTicket,
            'academicInfo' => $academicInfo
        ];

        if ($this->access->getRole('Администратор')) {
            View::render('Просмотр пользователя', 'user/view.php', $model);
        } else {
            View::render('Ошибка доступа', '/layouts/error_403.php');
        }
    }

    /**
     * Создание пользователя
     * @throws Exception
     */
    public function create()
    {
        $roleModel = new RoleModel();
        $readersTicketModel = new ReadersTicketModel();
        $divisionModel = new DivisionModel();
        $groupModel = new GroupModel();
        $academicDegreeModel = new AcademicDegreeModel();
        $academicTitleModel = new AcademicTitleModel();

        $resultRole = $roleModel->getAll();
        $resultReadersTicket = $readersTicketModel->getAll();
        $resultDivision = $divisionModel->getAll();
        $resultGroup = $groupModel->getAll();
        $resultAcademicDegree = $academicDegreeModel->getAll();
        $resultAcademicTitle = $academicTitleModel->getAll();

        $model = [
            'role' => $resultRole,
            'readersTicket' => $resultReadersTicket,
            'division' => $resultDivision,
            'group' => $resultGroup,
            'academicDegree' => $resultAcademicDegree,
            'academicTitle' => $resultAcademicTitle,
            'readersTicketModel' => $readersTicketModel
        ];
        if ($this->access->getRole('Администратор')) {
            if ($_POST) {
                $user = new User();
                $readersTicket = new ReadersTicket();
                $academicInfo = new ConnectAcademicInfo();
/////////////////////////////Создание пользователя//////////////////////////////
                $user->setLogin($_POST['login']);
                $user->setPassword(md5($_POST['password']));
                $user->setFullName($_POST['full_name']);
                $user->setActive($_POST['status']);
                $user->setRole($_POST['role']);
                $classRole = $this->entityManager->getRepository(':Role')->find($_POST['role']);
                $user->setRole($classRole);

                $this->entityManager->persist($user);
                $this->entityManager->flush();
/////////////////////////////Создание информации о сотруднике (научная степень, звание)///////////////
                if (!empty($_POST['degree'])) {
                    $classAcademicUser = $this->entityManager->getRepository(':User')->find($user->getIdUser());
                    $academicInfo->setIdUserConnect($classAcademicUser);

                    $classAcademicDegree = $this->entityManager->getRepository(':AcademicDegree')->find($_POST['degree']);
                    $academicInfo->setConnectAcademicInfoDegree($classAcademicDegree);

                    $classAcademicTitle = $this->entityManager->getRepository(':AcademicTitle')->find($_POST['title']);
                    $academicInfo->setConnectAcademicInfoTitle($classAcademicTitle);

                    $this->entityManager->persist($academicInfo);
                    $this->entityManager->flush();
                }
/////////////////////////////Создание читательского билета///////////////////////////////////////////
                $classUser = $this->entityManager->getRepository(':User')->find($user->getIdUser());
                $readersTicket->setUserConnect($classUser);
                $readersTicket->setIdPosition($_POST['position']);
                $readersTicket->setBlock(1);
                $classDivision = $this->entityManager->getRepository(':Division')->find($_POST['division']);
                $readersTicket->setIdDivisionConnect($classDivision);

/////////////////////////////Создание информации о студенте (курс, группа)///////////////////////////
                if (!empty($_POST['group'])) {
                    $readersTicket->setIdCourse($_POST['course']);
                    $classGroup = $this->entityManager->getRepository(':Group')->find($_POST['group']);
                    $readersTicket->setIdGroupConnect($classGroup);
                }
                $this->entityManager->persist($readersTicket);
                $this->entityManager->flush();

                View::redirect('/user/index');
            }
            View::render('Добавление пользователя', 'user/create.php', $model);
        } else View::render('Ошибка доступа', '/layouts/error_403.php');
    }

    /**
     * Обновление существующей записи (пользователя) в базе
     * @throws Exception
     */
    public function update()
    {

        $roleModel = new RoleModel();
        $view = new UserModels();
        $readersTicketModel = new ReadersTicketModel();
        $divisionModel = new DivisionModel();
        $groupModel = new GroupModel();
        $academicInfoModel = new ConnectAcademicInfoModel();
        $academicDegreeModel = new AcademicDegreeModel();
        $academicTitleModel = new AcademicTitleModel();

        $resultRole = $roleModel->getAll();
        $viewModel = $view->getOne();
        $resultReadersTicket = $readersTicketModel->getOne();
        $resultDivision = $divisionModel->getAll();
        $resultGroup = $groupModel->getAll();
        $academicDegree = $academicDegreeModel->getAll();
        $academicTitle = $academicTitleModel->getAll();
        $resultAcademicInfo = $academicInfoModel->getOne();

        $model = [
            'role' => $resultRole,
            'model' => $viewModel,
            'readersTicket' => $resultReadersTicket,
            'division' => $resultDivision,
            'group' => $resultGroup,
            'academicDegree' => $academicDegree,
            'academicTitle' => $academicTitle,
            'resultAcademicInfo' => $resultAcademicInfo,
            'readersTicketModel' => $readersTicketModel,
            'roleModel' => $roleModel
        ];
        if ($this->access->getRole('Администратор')) {
            if ($_POST) {
                $user = $this->entityManager->getRepository(User::class)->findOneBy(['id_user' => $_GET['id']]);
                $readersTicket = $this->entityManager->getRepository(ReadersTicket::class)->findOneBy(['id_user' => $_GET['id']]);
                $academicInfo = $this->entityManager->getRepository(ConnectAcademicInfo::class)->findOneBy(['id_user' => $_GET['id']]);
/////////////////////////////Изменение пользователя//////////////////////////////
                $user->setLogin($_POST['login']);
                if (!isset($_POST['password'])) {
                    $user->setPassword(md5($_POST['password']));
                }
                $user->setFullName($_POST['full_name']);
                $user->setActive($_POST['status']);
                $user->setRole($_POST['role']);
                $classRole = $this->entityManager->getRepository(':Role')->find($_POST['role'][0]);
                $user->setRole($classRole);

                $this->entityManager->persist($user);
                $this->entityManager->flush();
/////////////////////////////Изменение читательского билета, в том числе данных о студенте//////////////////////////////
                $classUser = $this->entityManager->getRepository(':User')->find($user->getIdUser());
                $readersTicket->setUserConnect($classUser);
                if (!empty($_POST['division'])) {
                    $classDivision = $this->entityManager->getRepository(':Division')->find($_POST['division']);
                    $readersTicket->setIdDivisionConnect($classDivision);
                }
                $readersTicket->setIdPosition($_POST['position']);
                if (!empty($_POST['course'])) {
                    $readersTicket->setIdCourse($_POST['course']);
                }
                if (!empty($_POST['group'])) {
                    $classGroup = $this->entityManager->getRepository(':Group')->find($_POST['group']);
                    $readersTicket->setIdGroupConnect($classGroup);
                }
                $readersTicket->setBlock(1);

                $this->entityManager->persist($readersTicket);
                $this->entityManager->flush();
/////////////////////////////Изменение информации о сотруднике (научная степень, звание)///////////////
                if (!empty($_POST['degree'])) {
                    $classAcademicDegree = $this->entityManager->getRepository(':AcademicDegree')->find($_POST['degree']);
                    $academicInfo->setConnectAcademicInfoDegree($classAcademicDegree);

                    $classAcademicTitle = $this->entityManager->getRepository(':AcademicTitle')->find($_POST['title']);
                    $academicInfo->setConnectAcademicInfoTitle($classAcademicTitle);

                    $this->entityManager->persist($academicInfo);
                    $this->entityManager->flush();
                }
                View::redirect('/user/index');
            }
            View::render('Главная страница', 'user/update.php', $model);
        } else View::render('Ошибка доступа', '/layouts/error_403.php');
    }


    /**
     * Удаление записи (пользователя)
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws Exception
     */
    public function delete()
    {
        if ($this->access->getRole('Администратор')) {
            $user = $this->entityManager->getRepository(User::class)->findOneBy(['id_user' => $_GET['id']]);

            $this->entityManager->remove($user);
            $this->entityManager->flush();

            View::redirect('/user/index');
        } else View::render('Ошибка доступа', '/layouts/error_403.php');
    }
}