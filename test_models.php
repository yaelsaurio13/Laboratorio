<?php

echo "<h1>Prueba de Modelos - Pugnela</h1>";

// Modelo User
require_once 'models/User.php';

$userModel = new User();

$email = "admin@pugnela.com";
$password = "Pugnela1234";

$user = $userModel->login($email, $password);

if($user) {

    echo "✅ Login exitoso: " . $user['nombre'] . "<br>";

} else {

    echo "❌ Login fallido<br>";
}

// Modelo Product
require_once 'models/Product.php';

$productModel = new Product();

$products = $productModel->getAll();

echo "<br>";
echo "✅ Roles encontrados: " . count($products) . "<br><br>";

foreach($products as $p) {

    echo "- " . $p['nombre'] . " - $ " . $p['precio'] . "<br>";
}

?>