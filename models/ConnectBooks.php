<?php

namespace App\models;

use Doctrine\ORM\Mapping as ORM;

/**
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
    protected $id_readers_ticket;

    /**
     * @ORM\Column(type="integer")
     */
    protected $id_books;

    /**
     * @ORM\Column(type="string")
     */
    protected $daate_tacking_books;

    /**
     * @ORM\Column(type="string")
     */
    protected $date_end_tacking_books;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $refund;

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
    public function getIdReadersTicket()
    {
        return $this->id_readers_ticket;
    }

    /**
     * @param mixed $id_readers_ticket
     */
    public function setIdReadersTicket($id_readers_ticket): void
    {
        $this->id_readers_ticket = $id_readers_ticket;
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
    public function getDaateTackingBooks()
    {
        return $this->daate_tacking_books;
    }

    /**
     * @param mixed $daate_tacking_books
     */
    public function setDaateTackingBooks($daate_tacking_books): void
    {
        $this->daate_tacking_books = $daate_tacking_books;
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
    public function getRefund()
    {
        return $this->refund;
    }

    /**
     * @param mixed $refund
     */
    public function setRefund($refund): void
    {
        $this->refund = $refund;
    }


}