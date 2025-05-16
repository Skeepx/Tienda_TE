<?php
    session_start();
    include 'db.php';

    if (!isset($_SESSION['email'])) {
        header("Location: login.php");
        exit();
    }

    $email = $_SESSION['email'];
    $consulta = "SELECT * FROM login WHERE email = '$email'";
    $resultado = mysqli_query($conexion, $consulta);
    $usuario = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="perfil-wrapper">
        <div class="perfil-card">
            <div class="perfil-header">
                <button class="btn-volver" onclick="window.location.href='menu.php'">← Menú</button>
            </div>

            <div class="perfil-imagen">
                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Foto de perfil">
            </div>
            <div class="perfil-nombre"><?= htmlspecialchars($usuario['nombre']) ?></div>
            <div class="perfil-email"><?= htmlspecialchars($usuario['email']) ?></div>

            <form action="eliminar_cuenta.php" method="post">
                <input type="hidden" name="email" value="<?= htmlspecialchars($usuario['email']) ?>">
                <button class="btn-eliminarP" onclick="return confirm('¿Estás seguro de que deseas eliminar tu cuenta?')">
                    Eliminar cuenta🗑️
                </button>
            </form>
        </div>
    </div>
</body>
</html>
