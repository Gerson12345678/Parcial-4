<?php
require_once 'core/Database.php';

class Book {
    private $conn;
    private $table = 'book';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Crear un libro
    public function create($data) {
        $query = "INSERT INTO " . $this->table . " SET TITLE = :title, DESCRIPTION = :description, YEAR_PUBLICATION = :year_publication, ID_AUTHOR = :id_author, ID_GENRE = :id_genre";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':year_publication', $data['year_publication']);
        $stmt->bindParam(':id_author', $data['id_author']);
        $stmt->bindParam(':id_genre', $data['id_genre']);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    // Actualizar un libro
    public function update($data) {
        $query = "UPDATE " . $this->table . " SET TITLE = :title, DESCRIPTION = :description, YEAR_PUBLICATION = :year_publication, ID_AUTHOR = :id_author, ID_GENRE = :id_genre WHERE ID_BOOK = :id_book";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id_book', $data['id_book']);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':year_publication', $data['year_publication']);
        $stmt->bindParam(':id_author', $data['id_author']);
        $stmt->bindParam(':id_genre', $data['id_genre']);

        return $stmt->execute();
    }

    // Eliminar un libro
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE ID_BOOK = :id_book";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_book', $id);

        return $stmt->execute();
    }

    // Obtener todos los libros
    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener todos los libros con el stock
    public function getAllWithStock() {
        $query = "SELECT b.ID_BOOK, b.TITLE, b.DESCRIPTION, b.YEAR_PUBLICATION, b.ID_AUTHOR, b.ID_GENRE, s.QUANTITYFROM " . $this->table . " bLEFT JOIN stock s ON b.ID_BOOK = s.BOOK_ID";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener el último ID insertado (libro)
    public function getLastInsertId() {
        return $this->conn->lastInsertId();
    }
}
?>
