<?php

namespace App\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="connect_academic_info")
 */
class ConnectAcademicInfo
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id_connect_academic_info;
    /**
     * @ORM\Column(type="integer")
     */
    protected $id_user;
    /**
     * @ORM\Column(type="integer")
     */
    protected $id_academic_degree;
    /**
     * @ORM\Column(type="integer")
     */
    protected $id_academic_title;


}