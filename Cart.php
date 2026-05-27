<?php

require_once 'config/database.php';

class Cart {

    private $conn;
    private $table_name = "carrito";

    public function __construct() {

        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function addToCart($usuario_id, $producto_id, $cantidad) {

        $query = "SELECT * FROM " . $this->table_name . "
                  WHERE usuario_id = :usuario_id
                  AND producto_id = :producto_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':producto_id', $producto_id);

        $stmt->execute();

        if($stmt->rowCount() > 0) {

            $query = "UPDATE " . $this->table_name . "
                      SET cantidad = cantidad + :cantidad
                      WHERE usuario_id = :usuario_id
                      AND producto_id = :producto_id";

        } else {

            $query = "INSERT INTO " . $this->table_name . "
                      (usuario_id, producto_id, cantidad)

                      VALUES

                      (:usuario_id, :producto_id, :cantidad)";
        }

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':producto_id', $producto_id);
        $stmt->bindParam(':cantidad', $cantidad);

        return $stmt->execute();
    }

    public function getCartItems($usuario_id) {

        $query = "SELECT c.*, p.nombre, p.precio, p.imagen

                  FROM " . $this->table_name . " c

                  JOIN productos p
                  ON c.producto_id = p.id

                  WHERE c.usuario_id = :usuario_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':usuario_id', $usuario_id);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function clearCart($usuario_id) {

        $query = "DELETE FROM " . $this->table_name . "
                  WHERE usuario_id = :usuario_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':usuario_id', $usuario_id);

        return $stmt->execute();
    }

    public function getCartTotal($usuario_id) {

        $items = $this->getCartItems($usuario_id);

        $total = 0;

        foreach($items as $item) {

            $total += $item['precio'] * $item['cantidad'];
        }

        return $total;
    }
}

?>