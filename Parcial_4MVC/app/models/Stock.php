<?php
require_once 'core/Database.php';

class Stock {
    private $conn;
    private $table = 'stock'; // Cambiar a la tabla stock

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Crear un registro de stock
    public function create($data) {
        $query = "INSERT INTO " . $this->table . " (ID_BOOK, TOTAL_STOCK, NOTES, LAST_INVENTORY) VALUES (:id_book, :total_stock, :notes, :last_inventory)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id_book', $data['id_book']);
        $stmt->bindParam(':total_stock', $data['total_stock']);
        $stmt->bindParam(':notes', $data['notes']);
        $stmt->bindParam(':last_inventory', $data['last_inventory']);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    // Actualizar un registro de stock
    public function update($data) {
        $query = "UPDATE " . $this->table . " SET ID_BOOK = :id_book, TOTAL_STOCK = :total_stock, NOTES = :notes, LAST_INVENTORY = :last_inventory WHERE ID_STOCK = :id_stock";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id_stock', $data['id_stock']);
        $stmt->bindParam(':id_book', $data['id_book']);
        $stmt->bindParam(':total_stock', $data['total_stock']);
        $stmt->bindParam(':notes', $data['notes']);
        $stmt->bindParam(':last_inventory', $data['last_inventory']);

        return $stmt->execute();
    }

    // Eliminar un registro de stock
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE ID_STOCK = :id_stock";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_stock', $id);

        return $stmt->execute();
    }

    // Obtener todos los registros de stock
    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener el último ID insertado
    public function getLastInsertId() {
        return $this->conn->lastInsertId();
    }
}
?>
