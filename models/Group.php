<?php

namespace App\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Сущность "ГРУППЫ" (данная сущность является связующей между базой и всем остальным)
 * @ORM\Entity
 * @ORM\Table(name="group_readers")
 */
class Group
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id_group;

    /**
     * @ORM\Column(type="string")
     */
    protected $group_name;

/////////////////////////////////////////////////Связи/////////////////////////////////

    /**
     * @var object
     *
     * @ORM\OneToMany(
     *      targetEntity="ReadersTicket",
     *      mappedBy="id_group_connect",
     *      cascade={"persist", "remove"}
     * )
     */
    protected $readers_ticket_group;
//////////////////////////////////////////////////////////////////////////////////////
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
    public function getGroupName()
    {
        return $this->group_name;
    }

    /**
     * @param mixed $group_name
     */
    public function setGroupName($group_name): void
    {
        $this->group_name = $group_name;
    }
}