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
     * @var object
     * @ORM\ManyToOne(targetEntity="User", inversedBy="connect_violation")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id_user", nullable=false)
     */
    protected $id_user;


    /**
     * @ORM\Column(type="integer")
     */
    protected $id_violation;


    /**
     * @var object
     *
     * @ORM\ManyToOne(targetEntity="Violation", inversedBy="connect_violation")
     * @ORM\JoinColumn(name="id_violation", referencedColumnName="id_violation", nullable=false)
     */
    protected $id_connect_violation;

    /**
     * @param mixed $id_connect_violations
     */
    public function setIdConnectViolations($id_connect_violations): void
    {
        $this->id_connect_violations = $id_connect_violations;
    }

    /**
     * @return object
     */
    public function getIdUser(): object
    {
        return $this->id_user;
    }

    /**
     * @param object $id_user
     */
    public function setIdUser(object $id_user): void
    {
        $this->id_user = $id_user;
    }

    /**
     * @return object
     */
    public function getIdViolations(): object
    {
        return $this->id_violations;
    }

    /**
     * @param object $id_violations
     */
    public function setIdViolations(object $id_violations): void
    {
        $this->id_violations = $id_violations;
    }

}