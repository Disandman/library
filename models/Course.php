<?php

namespace App\models;

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