<?php

namespace App\models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="academic_title")
 */
class AcademicTitle
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id_academic_title;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @var object
     *
     * @ORM\OneToMany(
     *      targetEntity="ConnectAcademicInfo",
     *      mappedBy="id_user",
     *      cascade={"persist", "remove"}
     * )
     */
    protected $connect_academic_info_title;

    /**
     *
     */
    public function __construct()
    {
        $this->connect_academic_info_title = new ArrayCollection();
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
    public function getConnectAcademicInfoTitle(): object
    {
        return $this->connect_academic_info_title;
    }

    /**
     * @param object $connect_academic_info_title
     */
    public function setConnectAcademicInfoTitle(object $connect_academic_info_title): void
    {
        $this->connect_academic_info_title = $connect_academic_info_title;
    }

}