<?php

namespace App\models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="course")
 */
class Course
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id_course;

    /**
     * @ORM\Column(type="string")
     */
    protected $cource;


    /**
     * @var object
     *
     * @ORM\OneToMany(
     *      targetEntity="ReadersTicket",
     *      mappedBy="id_cource",
     *      cascade={"persist", "remove"}
     * )
     */
    protected $readers_ticket_cource;

    /**
     *
     */
    public function __construct()
    {
        $this->readers_ticket_cource = new ArrayCollection();
    }

    /**
     * @param mixed $id_course
     */
    public function setIdCourse($id_course): void
    {
        $this->id_course = $id_course;
    }

    /**
     * @return mixed
     */
    public function getCource()
    {
        return $this->cource;
    }

    /**
     * @param mixed $cource
     */
    public function setCource($cource): void
    {
        $this->cource = $cource;
    }

}