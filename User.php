<?php

require_once __DIR__ . '/../config/database.php';

class User {

    private $conn;
    private $table_name = "usuarios";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function login($email, $password) {

        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if($stmt->rowCount() > 0) {

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if($password == $user['password']) {
                return $user;
            }
        }

        return false;
    }

    public function getUserById($id) {

        $query = "SELECT id, nombre, email FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>