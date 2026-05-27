<?php

session_start();

require_once 'models/Cart.php';
require_once 'models/User.php';

echo "<h1>🛒 Prueba del Carrito - Pugnela</h1>";

$userModel = new User();

$user = $userModel->login(
    'admin@pugnela.com',
    'Pugnela1234'
);

if($user) {

    echo "✅ Usuario logueado:
    {$user['nombre']}<br><br>";

    $cartModel = new Cart();

    $cartModel->clearCart($user['id']);

    echo "✅ Carrito limpiado<br><br>";

    echo "<h3>🍪 Agregando productos:</h3>";

    $cartModel->addToCart($user['id'], 1, 2);

    echo "✅ Rol clásico (2 piezas)<br>";

    $cartModel->addToCart($user['id'], 2, 1);

    echo "✅ Rol personalizado (1 pieza)<br>";

    echo "<h3>🛍️ Productos en carrito:</h3>";

    $items = $cartModel->getCartItems($user['id']);

    echo "<table border='1' cellpadding='10'>";

    echo "<tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Subtotal</th>
          </tr>";

    foreach($items as $item) {

        $subtotal =
        $item['precio'] * $item['cantidad'];

        echo "<tr>";

        echo "<td>{$item['nombre']}</td>";

        echo "<td>{$item['cantidad']}</td>";

        echo "<td>$ {$item['precio']}</td>";

        echo "<td>$ {$subtotal}</td>";

        echo "</tr>";
    }

    echo "</table>";

    $total = $cartModel->getCartTotal($user['id']);

    echo "<h2>Total:
    $ {$total}</h2>";

} else {

    echo "❌ Error de login";
}

?>