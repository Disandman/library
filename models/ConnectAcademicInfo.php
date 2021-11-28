<?php

namespace App\models;

use Doctrine\ORM\Mapping as ORM;

/**
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
     * @var object
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="connect_academic_info")
     * @ORM\JoinColumn(name="id_connect_academic_info", referencedColumnName="id_user", nullable=false, onDelete="CASCADE")
     */
    protected $id_user;

    /**
     * @var object
     *
     * @ORM\ManyToOne(targetEntity="AcademicDegree", inversedBy="connect_academic_info_degree")
     * @ORM\JoinColumn(name="id_academic_degree", referencedColumnName="id_academic_degree", nullable=false, onDelete="CASCADE")
     */
    protected $id_academic_degree;

    /**
     * @var object
     *
     * @ORM\ManyToOne(targetEntity="AcademicTitle", inversedBy="connect_academic_info_title")
     * @ORM\JoinColumn(name="id_academic_title", referencedColumnName="id_academic_title", nullable=false, onDelete="CASCADE")
     */
    protected $id_academic_title;

    /**
     * @param mixed $id_connect_academic_info
     */
    public function setIdConnectAcademicInfo($id_connect_academic_info): void
    {
        $this->id_connect_academic_info = $id_connect_academic_info;
    }

    /**
     * @return object
     */
    public function getIdUser(): object
    {
        return $this->id_user;
    }

    /**
     * @param object $id_user
     */
    public function setIdUser(object $id_user): void
    {
        $this->id_user = $id_user;
    }

    /**
     * @return object
     */
    public function getIdAcademicDegree(): object
    {
        return $this->id_academic_degree;
    }

    /**
     * @param object $id_academic_degree
     */
    public function setIdAcademicDegree(object $id_academic_degree): void
    {
        $this->id_academic_degree = $id_academic_degree;
    }

    /**
     * @return object
     */
    public function getIdAcademicTitle(): object
    {
        return $this->id_academic_title;
    }

    /**
     * @param object $id_academic_title
     */
    public function setIdAcademicTitle(object $id_academic_title): void
    {
        $this->id_academic_title = $id_academic_title;
    }

}