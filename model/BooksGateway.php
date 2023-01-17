<?php
require_once 'Database.php';

class booksGateway extends Database
{

    public function selectAll($order)
    {
        if (!isset($order)) {
            $order = 'isbn';
        }
        $pdo = Database::connect();
        $sql = $pdo->prepare("SELECT * FROM books ORDER BY $order ASC");
        $sql->execute();
        // $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        $books = array();
        while ($obj = $sql->fetch(PDO::FETCH_OBJ)) {

            $books[] = $obj;
        }
        return $books;
    }

    public function selectById($id)
    {
        $pdo = Database::connect();
        $sql = $pdo->prepare("SELECT * FROM books WHERE id = ?");
        $sql->bindValue(1, $id);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_OBJ);

        return $result;
    }

    public function insert($isbn, $title, $author, $country)
    {
        $pdo = Database::connect();
        $sql = $pdo->prepare("INSERT INTO books (isbn, title, author, country) VALUES (?, ?, ?, ?)");
        $result = $sql->execute(array($isbn, $title, $author, $country));
    }

    public function edit($isbn, $title, $author, $country, $id)
    {
        $pdo = Database::connect();
        $sql = $pdo->prepare("UPDATE books set isbn = ?, title = ?, author = ?, country = ? WHERE id = ? LIMIT 1");
        $result = $sql->execute(array($isbn, $title, $author, $country, $id));
    }

    public function delete($id)
    {
        $pdo = Database::connect();
        $sql = $pdo->prepare("DELETE FROM books WHERE id = ?");
        $sql->execute(array($id));
    }
}

?>
