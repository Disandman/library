<?php

namespace App\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="connect_violation")
 */
class ConnectViolation
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id_connect_violations;

    /**
     * @ORM\Column(type="integer")
     */
    protected $id_user;

    /**
     * @ORM\Column(type="integer")
     */
    protected $id_violations;


    /**
     * @param mixed $id_connect_violations
     */
    public function setIdConnectViolations($id_connect_violations): void
    {
        $this->id_connect_violations = $id_connect_violations;
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
    public function getIdViolations()
    {
        return $this->id_violations;
    }

    /**
     * @param mixed $id_violations
     */
    public function setIdViolations($id_violations): void
    {
        $this->id_violations = $id_violations;
    }


}