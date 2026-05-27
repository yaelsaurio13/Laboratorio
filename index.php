<?php
if(session_status() === PHP_SESSION_NONE) session_start();

if(!isset($_SESSION['user_id'])) {
    header('Location: index.php?action=login');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Pugnela</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family: Arial, sans-serif;
            background:#fff7f0;
        }

        .navbar{
            background:#8b5e3c;
            color:white;
            padding:1rem;
        }

        .nav-container{
            max-width:1200px;
            margin:auto;
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        .nav-links a{
            color:white;
            text-decoration:none;
            margin-left:20px;
        }

        .btn-logout{
            background:#d8a7b1;
            padding:8px 12px;
            border-radius:8px;
        }

        .container{
            max-width:1200px;
            margin:30px auto;
            padding:0 20px;
        }

        h2{
            color:#8b5e3c;
            margin-bottom:20px;
        }

        .products-grid{
            display:grid;
            grid-template-columns:repeat(auto-fill, minmax(280px,1fr));
            gap:20px;
        }

        .product-card{
            background:#fffaf5;
            border-radius:18px;
            padding:20px;
            text-align:center;
            box-shadow:0 4px 10px rgba(139,94,60,0.15);
            transition:0.3s;
        }

        .product-card:hover{
            transform:translateY(-5px);
        }

        .product-card img{
            width:100%;
            height:200px;
            object-fit:cover;
            border-radius:12px;
        }

        .product-card h3{
            margin:15px 0 10px;
            color:#6b4226;
        }

        .brand{
            color:#7d6b5d;
            font-size:14px;
        }

        .price{
            color:#b76e79;
            font-size:24px;
            font-weight:bold;
            margin:10px 0;
        }

        .stock{
            color:#8b5e3c;
            font-size:13px;
            margin-bottom:15px;
        }

        button{
            width:100%;
            padding:12px;
            border:none;
            border-radius:10px;
            background:#d8a7b1;
            color:white;
            cursor:pointer;
            font-size:15px;
        }

        button:hover{
            background:#c98c9a;
        }

        .success{
            background:#f3d6dc;
            color:#6b4226;
            padding:10px;
            border-radius:8px;
            margin-bottom:20px;
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="nav-container">
            <h1>🐶🍪 Pugnela</h1>

            <div class="nav-links">
                <span>✨ Hola, <?php echo $_SESSION['user_name']; ?></span>
                <a href="index.php?action=logout" class="btn-logout">🚪 Salir</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2>🍪 Nuestros Roles de Canela</h2>

        <?php if(isset($_SESSION['success'])): ?>
            <div class="success">
                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <div class="products-grid">

            <?php foreach($products as $product): ?>

                <div class="product-card">

                    <img src="<?php echo $product['imagen']; ?>" alt="<?php echo $product['nombre']; ?>">

                    <h3><?php echo $product['nombre']; ?></h3>

                    <p class="brand"><?php echo $product['marca']; ?></p>

                    <p class="price">$<?php echo number_format($product['precio'], 2); ?></p>

                    <p class="stock">📦 Disponibles: <?php echo $product['stock']; ?> piezas</p>

                    <form action="index.php?action=add-to-cart" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <button type="submit">🛒 Agregar al carrito</button>
                    </form>

                </div>

            <?php endforeach; ?>

        </div>
    </div>

</body>
</html>