<?php
require_once 'core/Database.php';

class Author {
    private $conn;
    private $table = 'author'; // Nombre de la tabla en la base de datos

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Crear un autor
    public function create($data) {
        $query = "INSERT INTO {$this->table} (FULL_NAME, DATE_OF_BIRTH, DATE_OF_DEATH) VALUES (:full_name, :date_of_birth, :date_of_death)";
        $stmt = $this->conn->prepare($query);

        // Enlazar los valores de la variable $data con los parámetros de la consulta
        $stmt->bindParam(':full_name', $data['full_name']);
        $stmt->bindParam(':date_of_birth', $data['date_of_birth']);
        $stmt->bindParam(':date_of_death', $data['date_of_death']);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return $this->conn->lastInsertId();  // Obtener el último ID insertado
        }
        return false;
    }

    // Actualizar un autor
    public function update($data) {
        $query = "UPDATE {$this->table} SET FULL_NAME = :full_name, DATE_OF_BIRTH = :date_of_birth, DATE_OF_DEATH = :date_of_death WHERE ID_AUTHOR = :id_author";
        $stmt = $this->conn->prepare($query);

        // Enlazar los valores de la variable $data con los parámetros de la consulta
        $stmt->bindParam(':id_author', $data['id_author']);
        $stmt->bindParam(':full_name', $data['full_name']);
        $stmt->bindParam(':date_of_birth', $data['date_of_birth']);
        $stmt->bindParam(':date_of_death', $data['date_of_death']);

        // Ejecutar la consulta
        return $stmt->execute();
    }

    // Eliminar un autor
    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE ID_AUTHOR = :id_author";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_author', $id, PDO::PARAM_INT);

        // Ejecutar la consulta
        return $stmt->execute();
    }

    // Obtener todos los autores
    public function getAll() {
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
