<?php

namespace App\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Сущность "Роли" (данная сущность является связующей между базой и всем остальным)
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
     * @ORM\Column(type="string", unique=true)
     */
    protected $name;

/////////////////////////////////////////////////Связи/////////////////////////////////
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
//////////////////////////////////////////////////////////////////////////////////////

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
     * @return object
     */
    public function getRole(): object
    {
        return $this->role;
    }

    /**
     * @param object $role
     */
    public function setRole(object $role): void
    {
        $this->role = $role;
    }
}