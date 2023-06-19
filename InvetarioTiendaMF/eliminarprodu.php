<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "tallerexamen";

$conexion = new mysqli($servername, $username, $password, $database);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if (isset($_POST['eliminar'])) {
    $id = $_POST['idprodu'];
    $id = mysqli_real_escape_string($conexion, $id);

    // Antes de eliminar la fila, debemos eliminar las filas relacionadas en la tabla "existencias"
    $sqlExistencias = "DELETE FROM existencias WHERE produ_id = $id";
    if ($conexion->query($sqlExistencias) === FALSE) {
        echo "Error al eliminar las filas relacionadas en la tabla existencias: " . $conexion->error;
        exit;
    }

    // Ahora podemos eliminar la fila en la tabla "producto"
    $sqlProducto = "DELETE FROM producto WHERE produ_id = $id";
    if ($conexion->query($sqlProducto) === TRUE) {
        header("Location: productos.php");
        exit;
    } else {
        echo "Error al eliminar el registro: " . $conexion->error;
    }
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar producto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body background="Imagenes/cajas.jpg" style="background-size: cover;">
<div class="eliminarprovee" style="border-radius: 10px;">
        <h1><b>ELIMINAR </b></h1>
        <form method="post">
            <div class="idprov">
                <input type="text" style="border: 3px solid #558aa8;" name="idprodu">
                <label>Ingrese el ID</label>
            </div>
            <input type="submit" value="Eliminar" name="eliminar">
        </form>
    </div>    
    <div class="mencrearprov" style="border-radius: 10px;">
        <button onclick="location.href='menu.php'"><b>=</b></button>
    </div>
    <div class="crearprov" style="border-radius: 10px;">
        <label><b>PRODUCTOS</b></label>
    </div>
    <input type="button" class="iconoprov" value="<" onclick="location.href='proveedores.php'" >
</body>
</html>