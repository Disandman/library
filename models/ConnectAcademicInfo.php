<?php

namespace App\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Промежуточная таблица (для сохранения научных званий и степеней)
 * @ORM\Entity
 * @ORM\Table(name="connect_academic_info")
 */
class ConnectAcademicInfo
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id_connect_academic_info;

    /**
     * @ORM\Column(type="integer")
     */
    protected $id_academic_title;

    /**
     * @ORM\Column(type="integer")
     */
    protected $id_academic_degree;

    /**
     * @ORM\Column(type="integer")
     */
    protected $id_user;

/////////////////////////////////////////////////Связи/////////////////////////////////

    /**
     * @var object
     * @ORM\ManyToOne(targetEntity="User", inversedBy="connect_academic_info")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id_user", nullable=false)
     */
    protected $id_user_connect;


    /**
     * @var object
     *
     * @ORM\ManyToOne(targetEntity="AcademicDegree", inversedBy="connect_academic_info_degree")
     * @ORM\JoinColumn(name="id_academic_degree", referencedColumnName="id_academic_degree", nullable=false, onDelete="CASCADE")
     */
    protected $connect_academic_info_degree;


    /**
     * @var object
     *
     * @ORM\ManyToOne(targetEntity="AcademicTitle", inversedBy="connect_academic_info_title")
     * @ORM\JoinColumn(name="id_academic_title", referencedColumnName="id_academic_title", nullable=false, onDelete="CASCADE")
     */
    protected $connect_academic_info_title;
//////////////////////////////////////////////////////////////////////////////////////
    /**
     * @return mixed
     */
    public function getIdConnectAcademicInfo()
    {
        return $this->id_connect_academic_info;
    }

    /**
     * @param mixed $id_connect_academic_info
     */
    public function setIdConnectAcademicInfo($id_connect_academic_info): void
    {
        $this->id_connect_academic_info = $id_connect_academic_info;
    }

    /**
     * @return mixed
     */
    public function getIdAcademicTitle()
    {
        return $this->id_academic_title;
    }

    /**
     * @param mixed $id_academic_title
     */
    public function setIdAcademicTitle($id_academic_title): void
    {
        $this->id_academic_title = $id_academic_title;
    }

    /**
     * @return mixed
     */
    public function getIdAcademicDegree()
    {
        return $this->id_academic_degree;
    }

    /**
     * @param mixed $id_academic_degree
     */
    public function setIdAcademicDegree($id_academic_degree): void
    {
        $this->id_academic_degree = $id_academic_degree;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id_user
     */
    public function setIdUser($id_user): void
    {
        $this->id_user = $id_user;
    }

    /**
     * @return object
     */
    public function getIdUserConnect()
    {
        return $this->id_user_connect;
    }

    /**
     * @param object $id_user_connect
     */
    public function setIdUserConnect($id_user_connect): void
    {
        $this->id_user_connect = $id_user_connect;
    }

    /**
     * @return object
     */
    public function getConnectAcademicInfoDegree()
    {
        return $this->connect_academic_info_degree;
    }

    /**
     * @param object $connect_academic_info_degree
     */
    public function setConnectAcademicInfoDegree($connect_academic_info_degree): void
    {
        $this->connect_academic_info_degree = $connect_academic_info_degree;
    }

    /**
     * @return object
     */
    public function getConnectAcademicInfoTitle()
    {
        return $this->connect_academic_info_title;
    }

    /**
     * @param object $connect_academic_info_title
     */
    public function setConnectAcademicInfoTitle($connect_academic_info_title): void
    {
        $this->connect_academic_info_title = $connect_academic_info_title;
    }
}