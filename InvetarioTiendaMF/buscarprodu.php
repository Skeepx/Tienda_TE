<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "tallerexamen";

$conexion = new mysqli($servername, $username, $password, $database);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$tableProductos = '';

if (isset($_POST['buscar'])) {
    $id = $_POST['id'];
    $id = mysqli_real_escape_string($conexion, $id);

    $sqlProductos = "SELECT * FROM producto WHERE produ_id = $id";
    $resultProductos = $conexion->query($sqlProductos);

    if ($resultProductos->num_rows > 0) {
        $tableProductos .= '<table class="table-productos">';
        $tableProductos .= '<tr>';
        $tableProductos .= '<th>ID</th>';
        $tableProductos .= '<th>Nombre</th>';
        $tableProductos .= '<th>Precio</th>';
        $tableProductos .= '<th>ID proveedor</th>';
        $tableProductos .= '<th>Fecha Entrada</th>';
        $tableProductos .= '</tr>';

        while ($rowProductos = $resultProductos->fetch_assoc()) {
            $tableProductos .= '<tr>';
            $tableProductos .= '<td>' . $rowProductos['produ_id'] . '</td>';
            $tableProductos .= '<td>' . $rowProductos['produ_nombre'] . '</td>';
            $tableProductos .= '<td>' . $rowProductos['produ_precio'] . '</td>';
            $tableProductos .= '<td>' . $rowProductos['prov_id'] . '</td>';
            $tableProductos .= '<td>' . $rowProductos['fech_entrada'] . '</td>';
            $tableProductos .= '</tr>';
        }

        $tableProductos .= '</table>';
    } else {
        $tableProductos = "No se encontró ningún producto con ese ID.";
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Productos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body background="Imagenes/cajas.jpg" style="background-size: cover;">
    <div class="container">
        <div class="buscarexis" style="border-radius: 10px;">
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
            <label><b>Productos</b></label>
        </div>
        <input type="button" class="iconoprov" value="<" onclick="location.href='productos.php'" >

        <?php echo $tableProductos; ?>
    </div>
</body>
</html>
