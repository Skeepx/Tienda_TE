<?php
    if(isset($_POST['registrar'])){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "tallerexamen";
    
        // Crear una conexión
        $conexion = new mysqli($servername, $username, $password, $database);
    
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }
    
        // Recuperar los datos del formulario
        $email = $_POST['correo'];
        $contrasena = $_POST['contrasena'];
    
        // Crear la consulta SQL con una sentencia INSERT INTO para insertar los datos en la tabla correspondiente
        $sql = "INSERT INTO login (email, contraseña) VALUES ('$email', '$contrasena')";
    
        // Ejecutar la consulta
        if ($conexion->query($sql) === TRUE) {
            header("Location:login.php");
            exit;
        } else {
            echo "Error al registrar: " . $conexion->error;
        }
    
        // Cerrar la conexión
        $conexion->close();
    }
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="style.css">
</head>
<body background="Imagenes/Iniciarsesion.jpg" style="background-size: cover;">

    <div class="registrar" style="border-radius: 10px;">
        <h1><b>Registro</b></h1>
        <form method="post">
            <div class="nombre">
                <label>Nombre</label>
                <input type="text" style="border: 3px solid rgb(113, 22, 199);" name="nombre" required>
            </div>
            <div class="email2">
                <label>Email</label>
                <input type="text" style="border: 3px solid rgb(113, 22, 199);" name="correo" required>
            </div>
            <div class="contraseña2">
                <Label>Contraseña</Label>
                <input type="password" style="border: 3px solid rgb(113, 22, 199);" name="contrasena" required>
            </div>
            <input type="submit" value="Crear cuenta" name="registrar">
            <center>
            <div class="registrar2">
                ¿Ya tienes cuenta? <a href="login.php"> <b>Inicia Sesión</b></a>
            </div>
            </center>
        </form>
    </div>    
    
</body>
</html>
