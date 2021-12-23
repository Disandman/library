<?php

namespace App\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Сущность "Пользователи" (данная сущность является связующей между базой и всем остальным)
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id_user;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $login;

    /**
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @ORM\Column(type="string")
     */
    protected $full_name;

    /**
     * @ORM\Column(type="integer")
     */
    protected $active;

/////////////////////////////////////////////////Связи/////////////////////////////////

    /**
     * @var object
     *
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="role")
     * @ORM\JoinColumn(name="role", referencedColumnName="id_role", nullable=false, onDelete="CASCADE")
     */
    protected $role;

    /**
     * @var object
     *
     * @ORM\OneToMany(
     *      targetEntity="ConnectViolation",
     *      mappedBy="id_user",
     *      cascade={"persist", "remove"}
     * )
     */
    protected $connect_violation;

    /**
     * @var object
     *
     * @ORM\OneToMany(
     *      targetEntity="ConnectAcademicInfo",
     *      mappedBy="id_user_connect",
     *      cascade={"persist", "remove"}
     * )
     */
    protected $connect_academic_info;

    /**
     * @var object
     *
     * @ORM\OneToMany(
     *      targetEntity="ConnectBooks",
     *      mappedBy="id_user_connect",
     *      cascade={"persist", "remove"}
     * )
     */
    protected $connect_books;

    /**
     * @var object
     *
     * @ORM\OneToMany(
     *      targetEntity="ReadersTicket",
     *      mappedBy="user_connect",
     *      cascade={"persist", "remove"}
     * )
     */
    protected $readers_ticket_user;
//////////////////////////////////////////////////////////////////////////////////////

    /**
     * @param mixed $id_user
     */
    public function setIdUser($id_user): void
    {
        $this->id_user = $id_user;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login): void
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->full_name;
    }

    /**
     * @param mixed $full_name
     */
    public function setFullName($full_name): void
    {
        $this->full_name = $full_name;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active): void
    {
        $this->active = $active;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role): void
    {
        $this->role = $role;
    }

    /**
     * @return object
     */
    public function getConnectViolation(): object
    {
        return $this->connect_violation;
    }

    /**
     * @param object $connect_violation
     */
    public function setConnectViolation(object $connect_violation): void
    {
        $this->connect_violation = $connect_violation;
    }

    /**
     * @return object
     */
    public function getConnectAcademicInfo(): object
    {
        return $this->connect_academic_info;
    }

    /**
     * @param object $connect_academic_info
     */
    public function setConnectAcademicInfo(object $connect_academic_info): void
    {
        $this->connect_academic_info = $connect_academic_info;
    }
}