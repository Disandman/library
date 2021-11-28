<?php

namespace App\models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="academic_degree")
 */
class AcademicDegree
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id_academic_degree;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @var object
     *
     * @ORM\OneToMany(
     *      targetEntity="ConnectAcademicInfo",
     *      mappedBy="connect_academic_info_degree",
     *      cascade={"persist", "remove"}
     * )
     */
    protected $connect_academic_info_degree;

    /**
     *
     */
    public function __construct()
    {
        $this->connect_academic_info_degree = new ArrayCollection();
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return object
     */
    public function getConnectAcademicInfoDegree(): object
    {
        return $this->connect_academic_info_degree;
    }

    /**
     * @param object $connect_academic_info_degree
     */
    public function setConnectAcademicInfoDegree(object $connect_academic_info_degree): void
    {
        $this->connect_academic_info_degree = $connect_academic_info_degree;
    }

}