<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "tallerexamen";

$conexion = new mysqli($servername, $username, $password, $database);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$tableExistencia = '';

if (isset($_POST['buscar'])) {
    $id = $_POST['id'];
    $id = mysqli_real_escape_string($conexion, $id);

    $sqlExistencia = "SELECT * FROM existencias WHERE exis_id = $id";
    $resultExistencia = $conexion->query($sqlExistencia);

    if ($resultExistencia->num_rows > 0) {
        $tableExistencia .= '<table class="table-existencias">';
        $tableExistencia .= '<tr>';
        $tableExistencia .= '<th>ID</th>';
        $tableExistencia .= '<th>Cantidad</th>';
        $tableExistencia .= '<th>ID Producto</th>';
        $tableExistencia .= '</tr>';

        while ($rowExistencia = $resultExistencia->fetch_assoc()) {
            $tableExistencia .= '<tr>';
            $tableExistencia .= '<td>' . $rowExistencia['exis_id'] . '</td>';
            $tableExistencia .= '<td>' . $rowExistencia['exis_cantidad'] . '</td>';
            $tableExistencia .= '<td>' . $rowExistencia['produ_id'] . '</td>';
            $tableExistencia .= '</tr>';
        }

        $tableExistencia .= '</table>';
    } else {
        $tableExistencia = "No se encontró ninguna existencia con ese ID.";
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar existencia por ID</title>
    <link rel="stylesheet" href="style.css">
</head>
<body background="Imagenes/cajas.jpg" style="background-size: cover;">
    <div class="buscarexis"  style="border-radius: 10px;">
        <h1>Buscar</h1>
        <form method="post">
            <label>Ingrese el ID:</label>
            <input type="text" style="border: 3px solid #558aa8;" name="id">
            <input type="submit" value="Buscar" name="buscar">
        </form>
    </div>
    <div class="mencrearprov" style="border-radius: 10px;">
        <button onclick="location.href='menu.php'"><b>=</b></button>
    </div>
    <div class="crearprov" style="border-radius: 10px;">
        <label><b>Existencias</b></label>
    </div>
    <input type="button" class="iconoprov" value="<" onclick="location.href='existencias.php'" >

    <?php echo $tableExistencia; ?>
</body>
</html>
