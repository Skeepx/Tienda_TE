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

    $cantidad = $_POST["cantidad"];
    $idprodu = $_POST["idprodu"];

    $sql = "INSERT INTO existencias (exis_cantidad, produ_id) VALUES ('$cantidad', '$idprodu')";

    if ($conexion->query($sql) === TRUE) {
        header("Location: existencias.php");
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
    <title>Crear existencias</title>
    <link rel="stylesheet" href="style.css">
</head>
<body background="Imagenes/cajas.jpg" style="background-size: cover;">
    <div class="crearprovee" style="border-radius: 10px;">
        <h1><b>CREAR</b></h1>
        <form method="post">
            <div class="nomprov">
                <input type="text" style="border: 3px solid #558aa8;" name="cantidad" requiered>
                <label>Ingrese cantidad</label>
            </div>
            <div class="direcprov">
                <input type="text" style="border: 3px solid #558aa8;" name="idprodu">
                <Label>Ingrese ID del producto</Label>
            </div>

            <input type="submit" value="Crear" name="crearexis">
        </form>
    </div>    
    <div class="mencrearprov" style="border-radius: 10px;">
        <button onclick="location.href='menu.php'"><b>=</b></button>
    </div>
    <div class="crearexiss" style="border-radius: 10px;">
        <label><b>EXISTENCIAS</b></label>
    </div>
    <input type="button" class="iconoprov" value="<" onclick="location.href='existencias.php'" >
</body>
</html>
