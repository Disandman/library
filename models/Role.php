<?php

namespace App\models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="role")
 */
class Role
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id_role;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;



    /**
     * @var object
     *
     * @ORM\OneToMany(
     *      targetEntity="User",
     *      mappedBy="role",
     *      cascade={"persist", "remove"}
     * )
     */
    protected $role;

    /**
     *
     */
    public function __construct() {
        $this->role = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getIdRole()
    {
        return $this->id_role;
    }

    /**
     * @param mixed $id_role
     */
    public function setIdRole($id_role): void
    {
        $this->id_role = $id_role;
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
     * @return ArrayCollection
     */
    public function getRole(): ArrayCollection
    {
        return $this->role;
    }

    /**
     * @param ArrayCollection $role
     */
    public function setRole(ArrayCollection $role): void
    {
        $this->role = $role;
    }

}