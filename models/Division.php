<?php

namespace App\models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="division")
 */
class Division
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id_division;

    /**
     * @ORM\Column(type="string")
     */
    protected $division;

/////////////////////////////////////////////////Связи/////////////////////////////////
    /**
     * @var object
     *
     * @ORM\OneToMany(
     *      targetEntity="ReadersTicket",
     *      mappedBy="id_division_connect",
     *      cascade={"persist", "remove"}
     * )
     */
    protected $readers_ticket_division;

    /**
     *
     */
    public function __construct()
    {
        $this->readers_ticket_division = new ArrayCollection();
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
    public function getDivision()
    {
        return $this->division;
    }

    /**
     * @param mixed $division
     */
    public function setDivision($division): void
    {
        $this->division = $division;
    }



}