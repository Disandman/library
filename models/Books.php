<?php

namespace App\models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Сущнось "КНИГИ" (данная сущность является связующей между базой и всем остальным)
 * @ORM\Entity
 * @ORM\Table(name="books")
 */
class Books
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id_books;

    /**
     * @ORM\Column(type="string")
     */
    protected $name_books;

    /**
     * @ORM\Column(type="string")
     */
    protected $author;

    /**
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @ORM\Column(type="float")
     */
    protected $price_books;

    /**
     * @ORM\Column(type="string")
     */
    protected $date_publication;

    /**
     * @ORM\Column(type="string")
     */
    protected $date_receipt;


/////////////////////////////////////////////////Связи/////////////////////////////////
    /**
     * @var object
     *
     * @ORM\OneToMany(
     *      targetEntity="ConnectBooks",
     *      mappedBy="id_books_connect",
     *      cascade={"persist", "remove"}
     * )
     */
    protected $connect_books;
//////////////////////////////////////////////////////////////////////////////////////
    /**
     *
     */
    public function __construct()
    {
        $this->connect_books = new ArrayCollection();
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
    public function getNameBooks()
    {
        return $this->name_books;
    }

    /**
     * @param mixed $name_books
     */
    public function setNameBooks($name_books): void
    {
        $this->name_books = $name_books;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getPriceBooks()
    {
        return $this->price_books;
    }

    /**
     * @param mixed $price_books
     */
    public function setPriceBooks($price_books): void
    {
        $this->price_books = $price_books;
    }

    /**
     * @return mixed
     */
    public function getDatePublication()
    {
        return $this->date_publication;
    }

    /**
     * @param mixed $date_publication
     */
    public function setDatePublication($date_publication): void
    {
        $this->date_publication = $date_publication;
    }

    /**
     * @return mixed
     */
    public function getDateReceipt()
    {
        return $this->date_receipt;
    }

    /**
     * @param mixed $date_receipt
     */
    public function setDateReceipt($date_receipt): void
    {
        $this->date_receipt = $date_receipt;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }
}