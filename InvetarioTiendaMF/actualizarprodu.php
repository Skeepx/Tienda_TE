<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "tallerexamen";

$conexion  = new mysqli($servername, $username, $password, $database);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$sql = "SELECT produ_id FROM producto";
$result = $conexion->query($sql);

if (isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $precio = mysqli_real_escape_string($conexion, $_POST['precio']);
    $fechaE = mysqli_real_escape_string($conexion, $_POST['fecha']);
    $idprov = mysqli_real_escape_string($conexion, $_POST['idprov']);

    $sql = "UPDATE producto SET produ_nombre = '$nombre', produ_precio = '$precio', prov_id = '$idprov',fech_entrada = '$fechaE' WHERE produ_id = $id";

    if ($conexion->query($sql) === TRUE) {
        header("Location: productos.php");
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
    <title>Actualizar productos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body background="Imagenes/cajas.jpg" style="background-size: cover;">
    <div class="actualizarprodu" style="border-radius: 10px;">
        <h1><b>ACTUALIZAR</b></h1>
        <form method="post">
        <div class="idprod">
                <label for="id">ID</label>
                <input type="text" style="border: 3px solid #558aa8;" name="id" required>
            </div>
            <div class="nomprodu">
                <input type="text" style="border: 3px solid #558aa8;" name="nombre" requiered>
                <label>Ingrese nombre</label>
            </div>
            <div class="precioprodu">
                <input type="text" style="border: 3px solid #558aa8;" name="precio" required>
                <Label>Ingrese precio</Label>
            </div>
            <div class="fechaprodu">
                <input type="datetime" style="border: 3px solid #558aa8;" name="fecha" requiered>
                <label>Ingrese fecha de entrega</label>
            </div>
            <div class="idprove">
                <input type="text" style="border: 3px solid #558aa8;" name="idprov" required>
                <Label>Ingrese el ID del proveedor</Label>
            </div>

            <input type="submit" value="Actualizar" name="actualizar">
        </form>
    </div>    
    <div class="mencrearprov" style="border-radius: 10px;">
        <button onclick="location.href='menu.php'"><b>=</b></button>
    </div>
    <div class="crearprov" style="border-radius: 10px;">
        <label><b>PRODUCTOS</b></label>
    </div>
    <input type="button" class="iconoprov" value="<" onclick="location.href='productos.php'" >
</body>
</html>