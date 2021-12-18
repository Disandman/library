<?php

namespace App\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Сущнось "КНИГИ ПОЛЬЗОВАТЕЛЯ" (данная сущность является связующей между базой и всем остальным)
 * @ORM\Entity
 * @ORM\Table(name="connect_books")
 */
class ConnectBooks
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id_connect_books;

    /**
     * @ORM\Column(type="integer")
     */
    protected $id_books;

    /**
     * @ORM\Column(type="integer")
     */
    protected $id_user;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $date_tacking_books;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $date_end_tacking_books;

    /**
     * @ORM\Column(type="integer")
     */
    protected $status;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $date_lost;

/////////////////////////////////////////Связи//////////////////////////////////////////

    /**
     * @var object
     *
     * @ORM\ManyToOne(targetEntity="Books", inversedBy="connect_books")
     * @ORM\JoinColumn(name="id_books", referencedColumnName="id_books", nullable=false, onDelete="CASCADE")
     */
    protected $id_books_connect;

    /**
     * @var object
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="connect_books")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id_user", nullable=false, onDelete="CASCADE")
     */
    protected $id_user_connect;
///////////////////////////////////////////////////////////////////////////////////////
    /**
     * @return mixed
     */
    public function getIdConnectBooks()
    {
        return $this->id_connect_books;
    }

    /**
     * @param mixed $id_connect_books
     */
    public function setIdConnectBooks($id_connect_books): void
    {
        $this->id_connect_books = $id_connect_books;
    }

    /**
     * @return mixed
     */
    public function getIdBooks()
    {
        return $this->id_books;
    }

    /**
     * @param mixed $id_books
     */
    public function setIdBooks($id_books): void
    {
        $this->id_books = $id_books;
    }

    /**
     * @return mixed
     */
    public function getDateTackingBooks()
    {
        return $this->date_tacking_books;
    }

    /**
     * @param mixed $daate_tacking_books
     */
    public function setDateTackingBooks($date_tacking_books): void
    {
        $this->date_tacking_books = $date_tacking_books;
    }

    /**
     * @return mixed
     */
    public function getDateEndTackingBooks()
    {
        return $this->date_end_tacking_books;
    }

    /**
     * @param mixed $date_end_tacking_books
     */
    public function setDateEndTackingBooks($date_end_tacking_books): void
    {
        $this->date_end_tacking_books = $date_end_tacking_books;
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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return object
     */
    public function getIdBooksConnect()
    {
        return $this->id_books_connect;
    }

    /**
     * @param object $id_books_connect
     */
    public function setIdBooksConnect($id_books_connect): void
    {
        $this->id_books_connect = $id_books_connect;
    }

    /**
     * @return object
     */
    public function getIdUserConnect()
    {
        return $this->id_user_connect;
    }

    /**
     * @param object $id_user_connect
     */
    public function setIdUserConnect($id_user_connect): void
    {
        $this->id_user_connect = $id_user_connect;
    }

    /**
     * @return mixed
     */
    public function getDateLost()
    {
        return $this->date_lost;
    }

    /**
     * @param mixed $date_lost
     */
    public function setDateLost($date_lost): void
    {
        $this->date_lost = $date_lost;
    }
}