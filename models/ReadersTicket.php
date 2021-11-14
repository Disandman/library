<?php

namespace App\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="readers_ticket")
 */
class ReadersTicket
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id_readers_ticket;

    /**
     * @ORM\Column(type="integer")
     */
    protected $id_user;

    /**
     * @ORM\Column(type="integer")
     */
    protected $id_division;

    /**
     * @ORM\Column(type="integer")
     */
    protected $id_course;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $block;

    /**
     * @ORM\Column(type="string")
     */
    protected $date_blocking;

    /**
     * @ORM\Column(type="string")
     */
    protected $date_unblocking;


    /**
     * @param mixed $id_readers_ticket
     */
    public function setIdReadersTicket($id_readers_ticket): void
    {
        $this->id_readers_ticket = $id_readers_ticket;
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
     * @return mixed
     */
    public function getIdDivision()
    {
        return $this->id_division;
    }

    /**
     * @param mixed $id_division
     */
    public function setIdDivision($id_division): void
    {
        $this->id_division = $id_division;
    }

    /**
     * @return mixed
     */
    public function getIdCourse()
    {
        return $this->id_course;
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
    public function getBlock()
    {
        return $this->block;
    }

    /**
     * @param mixed $block
     */
    public function setBlock($block): void
    {
        $this->block = $block;
    }

    /**
     * @return mixed
     */
    public function getDateBlocking()
    {
        return $this->date_blocking;
    }

    /**
     * @param mixed $date_blocking
     */
    public function setDateBlocking($date_blocking): void
    {
        $this->date_blocking = $date_blocking;
    }

    /**
     * @return mixed
     */
    public function getDateUnblocking()
    {
        return $this->date_unblocking;
    }

    /**
     * @param mixed $date_unblocking
     */
    public function setDateUnblocking($date_unblocking): void
    {
        $this->date_unblocking = $date_unblocking;
    }


}