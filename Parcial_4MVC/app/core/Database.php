<?php
class Database {
    private $host = "127.0.0.1"; // Dirección del servidor MySQL
    private $db_name = "library"; // Nombre de la base de datos (corregido)
    private $username = "root"; // Usuario MySQL
    private $password = ""; // Contraseña MySQL
    private $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Conexión fallida: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>

