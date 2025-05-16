<?php
    include 'db.php';
    session_start();
    if (!isset($_SESSION['nombre'])) {
        header("Location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="Menu-all">
        <div class="Nav-menu">
            <button onclick="location.href='login.php'"><b>Cerrar sesión</b></button>
            <div class="Tittle">
                <span>StockMaster</span>
            </div>
            <div class="Welcome">
                <span>Bienvenid@  
                    <a href="perfilu.php" class="perfil-link">
                    <?php echo htmlspecialchars($_SESSION['nombre']); ?> </a>
                </span>
            </div>
        </div>
        <div background="Imagenes/menu.jpg" class="Menu-options">
            <ul class="List-options">
                <li class="card">
                    <a href="proveedores.php" class="card-option">
                        <img src="imagenes/proveedor.avif" alt="Proveedores">
                        <span>PROVEEDORES</span>
                    </a>
                </li>
                <li class="card">
                    <a href="productos.php" class="card-option">
                        <img src="imagenes/Productos.png" alt="Productos">
                        <span>PRODUCTOS</span>
                    </a>
                </li>
                <li class="card">
                    <a href="existencias.php" class="card-option">
                        <img src="imagenes/existencias.webp" alt="Existencias">
                        <span>EXISTENCIAS</span>
                    </a>
                </li>
            </ul>

        </div>
    </div>
</body>
</html>