<?php

namespace BooksWebsiteProject\Models\Authors;

use BooksWebsiteProject\Models\ActiveRecordEntity;

class Authors extends ActiveRecordEntity
{
    /** @var string */
    protected $authorName;

    /** @var string */
    protected $createdAt;

    /**
     * @return string
     */
    public function getAuthorName(): string
    {
        return $this->authorName;
    }

    /**
     * @return string
     */
    protected static function getTableName(): string
    {
        return 'authors';
    }

    /**
     * @param string $authorName
     * @return null
     */
    public function setAuthorName($authorName)
    {
        $this->authorName=$authorName;
    }
}