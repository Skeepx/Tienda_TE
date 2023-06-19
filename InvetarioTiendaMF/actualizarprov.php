<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "tallerexamen";

$conexion  = new mysqli($servername, $username, $password, $database);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$sql = "SELECT prov_id FROM proveedor";
$result = $conexion->query($sql);

if (isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $direccion = mysqli_real_escape_string($conexion, $_POST['direc']);

    $sql = "UPDATE proveedor SET prov_nombre = '$nombre', prov_direc = '$direccion' WHERE prov_id = $id";

    if ($conexion->query($sql) === TRUE) {
        header("Location: proveedores.php");
            exit;
    } else {
        echo "Error al actualizar el registro: " . $conexion->error;
    }
}

$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar proveedores</title>
    <link rel="stylesheet" href="style.css">
</head>
<body background="Imagenes/cajas.jpg" style="background-size: cover;">
    <div class="actualizarprovee" style="border-radius: 10px;">
        <h1><b>ACTUALIZAR</b></h1>
        <form method="post">
            <div class="id">
                <label for="id">ID</label>
                <input type="text" style="border: 3px solid #558aa8;" name="id" required>
            </div>
            <div class="anomprov">
                <input type="text" style="border: 3px solid #558aa8;" name="nombre" required>
                <label>Ingrese el nombre</label>
            </div>
            <div class="adirecprov">
                <input type="text" style="border: 3px solid #558aa8;" name="direc" required>
                <label>Ingrese la dirección</label>
            </div>

            <input type="submit" value="Actualizar" name="actualizar">
        </form>
    </div>    
    <div class="mencrearprov" style="border-radius: 10px;">
        <button onclick="location.href='menu.php'"><b>=</b></button>
    </div>
    <div class="crearprov" style="border-radius: 10px;">
        <label><b>PROVEEDORES</b></label>
    </div>
    <input type="button" class="iconoprov" value="<" onclick="location.href='proveedores.php'" >
</body>
</html>
