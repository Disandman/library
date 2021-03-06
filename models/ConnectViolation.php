<?php

namespace App\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Сущность "НАРУШЕНИЯ" (данная сущность является связующей между базой и всем остальным)
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
    protected $id_violation;

/////////////////////////////////////////////////Связи/////////////////////////////////

    /**
     * @var object
     * @ORM\ManyToOne(targetEntity="User", inversedBy="connect_violation")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id_user", nullable=false)
     */
    protected $id_user;

    /**
     * @var object
     *
     * @ORM\ManyToOne(targetEntity="Violation", inversedBy="connect_violation")
     * @ORM\JoinColumn(name="id_violation", referencedColumnName="id_violation", nullable=false)
     */
    protected $id_connect_violation;
//////////////////////////////////////////////////////////////////////////////////////
    /**
     * @return mixed
     */
    public function getIdConnectViolations()
    {
        return $this->id_connect_violations;
    }

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
    public function getIdViolation()
    {
        return $this->id_violation;
    }

    /**
     * @param mixed $id_violation
     */
    public function setIdViolation($id_violation): void
    {
        $this->id_violation = $id_violation;
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
    public function getIdConnectViolation(): object
    {
        return $this->id_connect_violation;
    }

    /**
     * @param object $id_connect_violation
     */
    public function setIdConnectViolation(object $id_connect_violation): void
    {
        $this->id_connect_violation = $id_connect_violation;
    }


}