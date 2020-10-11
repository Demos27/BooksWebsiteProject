<?php

namespace BooksWebsiteProject\Models\Books;

use BooksWebsiteProject\Models\ActiveRecordEntity;
use BooksWebsiteProject\Models\Authors\Authors;

class Books extends ActiveRecordEntity
{
    /** @var string */
    protected $bookName;

    /** @var string */
    protected $description;

    /** @var int */
    protected $authorId;

    /** @var string */
    protected $createdAt;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->bookName;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getBookName(): string
    {
        return $this->bookName;
    }

    /**
     * @return Authors
     */
    public function getAuthor(): Authors
    {
        return Authors::getById($this->authorId);
    }

    /**
     * @return string
     */
    protected static function getTableName(): string
    {
        return 'books';
    }

    /**
     * @param string $bookName
     * @return null
     */
    public function setBookName($bookName): void
    {
        $this->bookName=$bookName;
    }

    /**
     * @param string $description
     * @return null
     */
    public function setDescription($description): void
    {
        $this->description=$description;
    }

    /**
     * @param Authors $author
     * @return null
     */
    public function setAuthor(Authors $author): void
    {
        $this->authorId=$author->getId();
    }
}