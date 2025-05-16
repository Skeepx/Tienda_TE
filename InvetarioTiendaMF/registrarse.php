<?php
if (isset($_POST['registrar'])) {
   include 'db.php';

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $nombre = $_POST['nombre'];
    $email = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $sql = "INSERT INTO login (nombre, email, contraseña) VALUES ('$nombre' ,'$email', '$contrasena')";

    if ($conexion->query($sql) === TRUE) {
        header("Location: login.php");
        exit;
    } else {
        echo "Error al registrar: " . $conexion->error;
    }

    $conexion->close();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="login">
        <div class="login-container">
            <div class="login-form">

                <h2>Crear cuenta</h2>
                <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>

                <form action="registrarse.php" method="post">

                    <div class="input-group">
                        <label for="nombre">¿Como quieres que te llamemos?</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Apodo" required>
                    </div>

                    <div class="input-group">
                        <label for="correo">Email</label>
                        <input type="email" id="correo" name="correo" placeholder="you@example.com" required>
                    </div>

                    <div class="input-group">
                        <label for="contrasena">Contraseña</label>
                        <input type="password" id="contrasena" name="contrasena" placeholder="Mínimo 6 caracteres" required>
                    </div>

                    <button type="submit" name="registrar" class="btn-login">Registrarse</button>

                </form>

            </div>

            <div class="login-image">
                <img src="imagenes/Iniciarsesion.jpg" alt="Imagen de registro">
            </div>
        </div>
    </div>
</body>

</html>