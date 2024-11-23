<?php
// los modelos necesarios
require_once 'models/Author.php';
require_once 'models/Book.php';
require_once 'models/Genre.php';
require_once 'models/Stock.php';

class LibraryController {
    private $authorModel;
    private $bookModel;
    private $genreModel;
    private $stockModel;

    public function __construct() {
        // Inicializa los modelos
        $this->authorModel = new Author();
        $this->bookModel = new Book();
        $this->genreModel = new Genre();
        $this->stockModel = new Stock();
    }

    // CRUD para Author
    public function manageAuthors() {
        $action = isset($_GET['action']) ? $_GET['action'] : '';

        switch ($action) {
            case 'create':
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['author_name'])) {
                    // Validación 
                    $this->authorModel->create($_POST);
                }
                include 'views/authorView.php';
                break;

            case 'update':
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['author_name'], $_POST['id_author'])) {
                    // Validación 
                    $this->authorModel->update($_POST);
                }
                include 'views/authorView.php';
                break;

            case 'delete':
                if (isset($_GET['id'])) {
                    // Validar si el ID es válido
                    $this->authorModel->delete($_GET['id']);
                }
                include 'views/authorView.php';
                break;

            default:
                $authors = $this->authorModel->getAll();
                include 'views/authorView.php';
                break;
        }
    }

    // CRUD para Book
    public function manageBooks() {
        $action = isset($_GET['action']) ? $_GET['action'] : '';

        switch ($action) {
            case 'create':
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['book_title'])) {
                    // Validación 
                    $this->bookModel->create($_POST);
                }
                include 'views/bookView.php';
                break;

            case 'update':
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['book_title'], $_POST['id_book'])) {
                    // Validación 
                    $this->bookModel->update($_POST);
                }
                include 'views/bookView.php';
                break;

            case 'delete':
                if (isset($_GET['id'])) {
                    // Validar si el ID es válido
                    $this->bookModel->delete($_GET['id']);
                }
                include 'views/bookView.php';
                break;

            default:
                $books = $this->bookModel->getAll();
                include 'views/bookView.php';
                break;
        }
    }

    // CRUD para Genre
    public function manageGenres() {
        $action = isset($_GET['action']) ? $_GET['action'] : '';

        switch ($action) {
            case 'create':
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['genre_name'])) {
                    // Validación 
                    $this->genreModel->create($_POST);
                }
                include 'views/genreView.php';
                break;

            case 'update':
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['genre_name'], $_POST['id_genre'])) {
                    // Validación 
                    $this->genreModel->update($_POST);
                }
                include 'views/genreView.php';
                break;

            case 'delete':
                if (isset($_GET['id'])) {
                    // Validar si el ID es válido
                    $this->genreModel->delete($_GET['id']);
                }
                include 'views/genreView.php';
                break;

            default:
                $genres = $this->genreModel->getAll();
                include 'views/genreView.php';
                break;
        }
    }

    // CRUD para Stock
    public function manageStock() {
        $action = isset($_GET['action']) ? $_GET['action'] : '';

        switch ($action) {
            case 'create':
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['book_id'], $_POST['quantity'])) {
                    // Validación 
                    $this->stockModel->create($_POST);
                }
                include 'views/stockView.php';
                break;

            case 'update':
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['book_id'], $_POST['quantity'], $_POST['id_stock'])) {
                    // Validación 
                    $this->stockModel->update($_POST);
                }
                include 'views/stockView.php';
                break;

            case 'delete':
                if (isset($_GET['id'])) {
                    // Validar si el ID es válido
                    $this->stockModel->delete($_GET['id']);
                }
                include 'views/stockView.php';
                break;

            default:
                $stocks = $this->stockModel->getAll();
                include 'views/stockView.php';
                break;
        }
    }
}
?>
