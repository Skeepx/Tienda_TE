<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "tallerexamen";

$conexion = new mysqli($servername, $username, $password, $database);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$tableProveedor = '';

if (isset($_POST['buscar'])) {
    $id = $_POST['id'];
    $id = mysqli_real_escape_string($conexion, $id);

    $sqlProveedor = "SELECT * FROM proveedor WHERE prov_id = $id";
    $resultProveedor = $conexion->query($sqlProveedor);

    if ($resultProveedor->num_rows > 0) {
        $tableProveedor .= '<table class="table-existencias">';
        $tableProveedor .= '<tr>';
        $tableProveedor .= '<th>ID</th>';
        $tableProveedor .= '<th>Nombre</th>';
        $tableProveedor .= '<th>Direccion</th>';
        $tableProveedor .= '</tr>';

        while ($rowProveedor = $resultProveedor->fetch_assoc()) {
            $tableProveedor .= '<tr>';
            $tableProveedor .= '<td>' . $rowProveedor['prov_id'] . '</td>';
            $tableProveedor .= '<td>' . $rowProveedor['prov_nombre'] . '</td>';
            $tableProveedor .= '<td>' . $rowProveedor['prov_direc'] . '</td>';
            $tableProveedor .= '</tr>';
        }

        $tableProveedor .= '</table>';
    } else {
        $tableProveedor = "No se encontró ningun Proveedor.";
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Proveedor</title>
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
        <label><b>Proveedor</b></label>
    </div>
    <input type="button" class="iconoprov" value="<" onclick="location.href='proveedores.php'" >

    <?php echo $tableProveedor; ?>
</body>
</html>