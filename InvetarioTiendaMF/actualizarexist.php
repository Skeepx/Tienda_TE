<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "tallerexamen";

$conexion  = new mysqli($servername, $username, $password, $database);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$sql = "SELECT exis_id FROM existencias";
$result = $conexion->query($sql);

if (isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $cantidad = mysqli_real_escape_string($conexion, $_POST['cantidad']);
    $idprod = mysqli_real_escape_string($conexion, $_POST['prodid']);

    $sql = "UPDATE existencias SET exis_cantidad = '$cantidad', produ_id = '$idprod' WHERE exis_id = $id";

    if ($conexion->query($sql) === TRUE) {
        header("Location: existencias.php");
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
    <title>Actualizar Existencias</title>
    <link rel="stylesheet" href="style.css">
</head>
<body background="Imagenes/cajas.jpg" style="background-size: cover;">
    <div class="actualizarexis" style="border-radius: 10px;">
        <h1><b>ACTUALIZAR</b></h1>
        <form method="post">
        <div class="idprod">
                <label for="id">ID</label>
                <input type="text" style="border: 3px solid #558aa8;" name="id" required>
            </div>
            <div class="nomprov">
                <input type="text" style="border: 3px solid #558aa8;" name="cantidad" requiered>
                <label>Ingrese cantidad</label>
            </div>
            <div class="direcprov">
                <input type="text" style="border: 3px solid #558aa8;" name="prodid" required>
                <Label>Ingrese ID del producto</Label>
            </div>

            <input type="submit" value="Actualizar" name="actualizar">
        </form>
    </div>    
    <div class="menuexis" style="border-radius: 10px;">
        <button onclick="location.href='menu.php'"><b>=</b></button>
    </div>
    <div class="exisss" style="border-radius: 10px;">
        <label><b>EXISTENCIAS</b></label>
    </div>
    <input type="button" class="iconoprov" value="<" onclick="location.href='existencias.php'" >
</body>
</html>