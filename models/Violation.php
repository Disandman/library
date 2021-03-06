<?php

namespace App\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Сущность "Нарушения" (данная сущность является связующей между базой и всем остальным)
 * @ORM\Entity
 * @ORM\Table(name="violation")
 */
class Violation
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id_violation;

    /**
     * @ORM\Column(type="string")
     */
    protected $name_violations;

    /**
     * @ORM\Column(type="float")
     */
    protected $price_violations;

/////////////////////////////////////////////////Связи/////////////////////////////////

    /** @ORM\OneToMany(targetEntity="ConnectViolation", mappedBy="id_connect_violation") */
    protected $connect_violation;
//////////////////////////////////////////////////////////////////////////////////////
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
     * @return mixed
     */
    public function getNameViolations()
    {
        return $this->name_violations;
    }

    /**
     * @param mixed $name_violations
     */
    public function setNameViolations($name_violations): void
    {
        $this->name_violations = $name_violations;
    }

    /**
     * @return mixed
     */
    public function getPriceViolations()
    {
        return $this->price_violations;
    }

    /**
     * @param mixed $price_violations
     */
    public function setPriceViolations($price_violations): void
    {
        $this->price_violations = $price_violations;
    }

    /**
     * @return mixed
     */
    public function getConnectViolation()
    {
        return $this->connect_violation;
    }

    /**
     * @param mixed $connect_violation
     */
    public function setConnectViolation($connect_violation): void
    {
        $this->connect_violation = $connect_violation;
    }
}