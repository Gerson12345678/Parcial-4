<?php
require_once 'core/Database.php';

class Genre {
    private $conn;
    private $table = 'genre';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table . " SET NAME = :name";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name', $data['name']);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();  // Obtener el último ID insertado
        }
        return false;
    }

    public function update($data) {
        $query = "UPDATE " . $this->table . " SET NAME = :name WHERE ID_GENRE = :id_genre";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id_genre', $data['id_genre']);
        $stmt->bindParam(':name', $data['name']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE ID_GENRE = :id_genre";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_genre', $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener el último ID insertado (género)
    public function getLastInsertId() {
        return $this->conn->lastInsertId();
    }
}
?>
