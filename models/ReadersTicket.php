<?php

namespace App\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Сущность "ЧИТАТЕЛЬСКИЕ БИЛЕТЫ" (данная сущность является связующей между базой и всем остальным)
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
     * @ORM\Column(type="integer",nullable=true)
     */
    protected $id_division;


    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    protected $id_course;

    /**
     * @ORM\Column(type="integer")
     */
    protected $id_position;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    protected $id_group;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $block;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    protected $date_blocking;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    protected $date_unblocking;
/////////////////////////////////////////////////Связи/////////////////////////////////
    /**
     * @var object
     *
     * @ORM\ManyToOne(targetEntity="Division", inversedBy="readers_ticket_division")
     * @ORM\JoinColumn(name="id_division", referencedColumnName="id_division", nullable=false, onDelete="CASCADE")
     */
    protected $id_division_connect;

    /**
     * @var object
     *
     * @ORM\ManyToOne(targetEntity="Group", inversedBy="readers_ticket_group")
     * @ORM\JoinColumn(name="id_group", referencedColumnName="id_group", nullable=false, onDelete="CASCADE")
     */
    protected $id_group_connect;


    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="readers_ticket_user")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id_user",onDelete="CASCADE")
     */
    private $user_connect;
/////////////////////////////////////////////////////////////////////////////////////
    /**
     * @return mixed
     */
    public function getIdReadersTicket()
    {
        return $this->id_readers_ticket;
    }

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
    public function getIdPosition()
    {
        return $this->id_position;
    }

    /**
     * @param mixed $id_position
     */
    public function setIdPosition($id_position): void
    {
        $this->id_position = $id_position;
    }

    /**
     * @return mixed
     */
    public function getIdGroup()
    {
        return $this->id_group;
    }

    /**
     * @param mixed $id_group
     */
    public function setIdGroup($id_group): void
    {
        $this->id_group = $id_group;
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

    /**
     * @return object
     */
    public function getIdDivisionConnect()
    {
        return $this->id_division_connect;
    }

    /**
     * @param object $id_division_connect
     */
    public function setIdDivisionConnect($id_division_connect): void
    {
        $this->id_division_connect = $id_division_connect;
    }

    /**
     * @return object
     */
    public function getIdGroupConnect()
    {
        return $this->id_group_connect;
    }

    /**
     * @param object $id_group_connect
     */
    public function setIdGroupConnect($id_group_connect): void
    {
        $this->id_group_connect = $id_group_connect;
    }

    /**
     * @return mixed
     */
    public function getUserConnect()
    {
        return $this->user_connect;
    }

    /**
     * @param mixed $user_connect
     */
    public function setUserConnect($user_connect): void
    {
        $this->user_connect = $user_connect;
    }
}