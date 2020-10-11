<?php

namespace BooksWebsiteProject\Controllers;

use BooksWebsiteProject\Models\Api;
use BooksWebsiteProject\Models\Books\Books;
use BooksWebsiteProject\Models\Authors\Authors;


class BooksApiController extends Api
{

    /**
     * GET
     * @return array
     */
    public function getList(): array
    {
        $limit = $this->requestParams['limit'] ?? 10;

        $offset = $this->requestParams['offset'] ?? 0;

        $list=Books::findAllWithParams( $limit, $offset);

        $result=[];

        foreach($list as $string)
        {
            $result[$string->getBookName()]= $string->getAuthor()->getAuthorName();
        }
        return $this->response($result,200);

    }


    /**
     * POST
     * @return array
     */
    public function add(): array
    {
        $bookName = $this->requestParams['bookname'] ?? '';

        $authorName = $this->requestParams['author'] ?? '';

        $description = $this->requestParams['description'] ?? '';

        $author=new Authors();

        $author->setAuthorName($authorName);

        $author->save();

        $author = Authors::getById($author->getId());

        $books = new Books();

        $books->setBookName($bookName);

        $books->setDescription($description);

        $books->setAuthor($author);

        $books->save();

        return $this->response(['result'=>true],200);

    }
    /**
     * DELETE
     * @return array
     */
    public function delete(): array
    {
        $bookId = $this->requestParams['id'] ?? -1;

        if($bookId==-1)
        {
            return $this->response('Parameters not declared',404);
        }

        $books=new Books();

        if($books->getById($bookId)==null)
        {
            return $this->response('Data not found',404);
        }

        $books->deleteById($bookId);

        return $this->response('Sucessfull',200);

    }

    /**
     * PUT
     * @return array
     */
    public function edit(): array
    {
        $bookId = $this->requestParams['id'] ?? -1;

        $bookName = $this->requestParams['bookname'] ?? '';

        $authorName = $this->requestParams['author'] ?? '';

        $description = $this->requestParams['description'] ?? '';

        if($bookId==-1 || $bookName=='' || $authorName=='' || $description=='')
        {
            return $this->response('Parameters not declared',404);
        }

        $books=new Books();

        if($books->getById($bookId)==null)
        {
            return $this->response('Data not found',404);
        }

        $author= new Authors();

        $author->setAuthorName($authorName);

        $author->save();

        $books->setId($bookId);

        $books->setBookName($bookName);

        $books->setDescription($description);

        $books->setAuthor($author);

        $books->save();

        return $this->response('Sucessfull',200);

    }

    /**
     * POST
     * @return array
     */
    public function addAuthor()
    {
        $authorName = $this->requestParams['author'] ?? '';

        if($authorName=='')
        {
            return $this->response('Parameters not declared',404);
        }

        $author = new Authors();

        $author->setAuthorName($authorName);

        $author->save();

        return $this->response('Sucessfull',200);

    }

}