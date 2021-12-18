<?php

namespace App\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Сущность "Научные степени" (данная сущность является связующей между базой и всем остальным)
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

/////////////////////////////////////////////////Связи/////////////////////////////////
    /**
     * @var object
     *
     * @ORM\OneToMany(
     *      targetEntity="ConnectAcademicInfo",
     *      mappedBy="connect_academic_info_title",
     *      cascade={"persist", "remove"}
     * )
     */
    protected $connect_academic_info_title;

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