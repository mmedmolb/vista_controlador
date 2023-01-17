<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/Autoloader.php';
require_once ROOT_PATH . '/model/BooksService.php';

class BooksController
{
    private $booksService = null;

    public function __construct()
    {
        $this->booksService = new BooksService();
    }

    public function redirect($location)
    {
        header('Location: ' . $location);
    }

    public function handleRequest()
    {
        $op = isset($_GET['op']) ? $_GET['op'] : null;

        try {

            if (!$op || $op == 'list') {
                $this->listBooks();
            } elseif ($op == 'new') {
                $this->saveBook();
            } elseif ($op == 'edit') {
                $this->editBook();
            } elseif ($op == 'delete') {
                $this->deleteBook();
            } elseif ($op == 'show') {
                $this->showBook();
            } else {
                $this->showError("Page not found", "Page for operation " . $op . " was not found!");
            }
        } catch (Exception $e) {
            $this->showError("Application error", $e->getMessage());
        }
    }

    public function listBooks()
    {
        $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : null;
        $books = $this->booksService->getAllBooks($orderby);
        include ROOT_PATH . '/view/books.php';

    }

    public function saveBook()
    {
        $titlePage = 'Add new book';

        $isbn = '';
        $title = '';
        $author = '';
        $country = '';

        $errors = array();

        if (isset($_POST['form-submitted'])) {

            $isbn = isset($_POST['isbn']) ? trim($_POST['isbn']) : null;
            $title = isset($_POST['title']) ? trim($_POST['title']) : null;
            $author = isset($_POST['author']) ? trim($_POST['author']) : null;
            $country = isset($_POST['country']) ? trim($_POST['country']) : null;

            try {
                $this->booksService->createNewBook($isbn, $title, $author, $country);
                $this->redirect('index.php');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }
        // include 'view/book-form.php';
        include ROOT_PATH . '/view/book-form.php';
    }

    public function editBook()
    {
        $titlePage = "Edit Book";

        $isbn = '';
        $title = '';
        $author = '';
        $country = '';
        $id = $_GET['id'];

        $errors = array();

        $book = $this->booksService->getBook($id);

        if (isset($_POST['form-submitted'])) {

            $isbn = isset($_POST['isbn']) ? trim($_POST['isbn']) : null;
            $title = isset($_POST['title']) ? trim($_POST['title']) : null;
            $author = isset($_POST['author']) ? trim($_POST['author']) : null;
            $country = isset($_POST['country']) ? trim($_POST['country']) : null;

            try {
                $this->booksService->editBook($isbn, $title, $author, $country, $id);
                $this->redirect('index.php');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }
        // Include in the view of the edit form
        include ROOT_PATH . 'view/book-form-edit.php';
    }

    public function deleteBook()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if (!$id) {
            throw new Exception('Internal error');
        }
        $this->booksService->deleteBook($id);

        $this->redirect('index.php');
    }

    public function showBook()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        $errors = array();

        if (!$id) {
            throw new Exception('Internal error');
        }
        $book = $this->booksService->getBook($id);

        include ROOT_PATH . 'view/book.php';
    }

    public function showError($titlePage, $message)
    {
        include ROOT_PATH . 'view/error.php';
    }
}