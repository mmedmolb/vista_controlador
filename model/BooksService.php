<?php

require_once 'BooksGateway.php';
require_once 'ValidationException.php';
require_once 'Database.php';

class BooksService extends BooksGateway
{

    private $booksGateway = null;

    public function __construct()
    {
        $this->BooksGateway = new BooksGateway();
    }

    public function getAllBooks($order)
    {
        try {
            self::connect();
            $res = $this->BooksGateway->selectAll($order);
            self::disconnect();
            return $res;
        } catch (Exception $e) {
            self::disconnect();
            throw $e;
        }
    }

    public function getBook($id)
    {
        try {
            self::connect();
            $result = $this->BooksGateway->selectById($id);
            self::disconnect();
            return $result;
        } catch (Exception $e) {
            self::disconnect();
            throw $e;
        }
        return $this->booksGateway->selectById($id);
    }

    private function validateBookParams($isbn, $title, $author, $country)
    {
        $errors = array();
        if (!isset($isbn) || empty($isbn)) {
            $errors[] = 'isbn is required';
        }
        if (!isset($title) || empty($title)) {
            $errors[] = 'title number is required';
        }
        if (!isset($country) || empty($country)) {
            $errors[] = 'country author is required';
        }
        if (!isset($author) || empty($author)) {
            $errors[] = 'author field is required';
        }
        if (empty($errors)) {
            return;
        }
        throw new ValidationException($errors);
    }

    public function createNewBook($isbn, $title, $country, $author)
    {
        try {
            self::connect();
            $this->validateBookParams($isbn, $title, $country, $author);
            $result = $this->BooksGateway->insert($isbn, $title, $country, $author);
            self::disconnect();
            return $result;
        } catch (Exception $e) {
            self::disconnect();
            throw $e;

        }
    }

    public function editBook($isbn, $title, $country, $author, $id)
    {
        try {
            self::connect();
            $result = $this->BooksGateway->edit($isbn, $title, $country, $author, $id);
            self::disconnect();
        } catch (Exception $e) {
            self::disconnect();
            throw $e;
        }
    }

    public function deleteBook($id)
    {
        try {
            self::connect();
            $result = $this->BooksGateway->delete($id);
            self::disconnect();
        } catch (Exception $e) {
            self::disconnect();
            throw $e;
        }
    }
}

?>
