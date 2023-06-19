<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "tallerexamen";

    $conexion = new mysqli($servername, $username, $password, $database);

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $idprov= $_POST["idprov"];
    $fechaE= $_POST["fechaE"];

    $sql = "INSERT INTO producto (produ_nombre, produ_precio, prov_id, fech_entrada ) VALUES ('$nombre', '$precio', '$idprov', '$fechaE')";

    if ($conexion->query($sql) === TRUE) {
        header("Location: productos.php");
            exit;
    } else {
        echo "Error al insertar datos: " . $conexion->error;
    }

    $conexion->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear producto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body background="Imagenes/cajas.jpg" style="background-size: cover;">
    <div class="crearprodu" style="border-radius: 10px;" >
        <h1><b>CREAR PRODUCTO</b></h1>
        <form method="post">
            <div class="nomprodu">
                <input type="text" style="border: 3px solid #558aa8;" name="nombre" requiered>
                <label>Ingrese nombre</label>
            </div>
            <div class="precioprodu">
                <input type="text" style="border: 3px solid #558aa8;" name="precio">
                <Label>Ingrese precio</Label>
            </div>
            <div class="fechaprodu">
                <input type="datetime" style="border: 3px solid #558aa8;" name="fechaE" requiered>
                <label>Ingrese fecha de entrega</label>
            </div>
            <div class="idprove">
                <input type="text" style="border: 3px solid #558aa8;" name="idprov" required>
                <Label>Ingrese el ID del proveedor</Label>
            </div>

            <input type="submit" value="Crear" name="crearprodu">
        </form>
    </div>    
    <div class="mencrearprov" style="border-radius: 10px;">
        <button onclick="location.href='menu.php'"><b>=</b></button>
    </div>
    <div class="crearprodd" style="border-radius: 10px;">
        <label><b>PRODUCTOS</b></label>
    </div>
    <input type="button" class="iconoprov" value="<" onclick="location.href='productos.php'" >
</body>
</html>