<?php
include 'db.php';

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$proveedor = [
    'prov_id' => '',
    'prov_nombre' => '',
    'prov_tel' => ''
];

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM proveedor WHERE prov_id = $id";
    $resultado = $conexion->query($sql);
    if ($resultado && $resultado->num_rows > 0) {
        $proveedor = $resultado->fetch_assoc();
    } else {
        echo "Proveedor no encontrado.";
        exit;
    }
}

if (isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $direccion = mysqli_real_escape_string($conexion, $_POST['tel']);

    $sql = "UPDATE proveedor SET prov_nombre = '$nombre', prov_tel = '$direccion' WHERE prov_id = $id";

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar proveedores</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="fondo-personalizado">
    <div class="barra-superior">
        <div class="menu-btn">
            <button onclick="location.href='menu.php'">≡</button>
        </div>
        <div class="titulo">
            <label><b>ACTUALIZAR PROVEEDOR</b></label>
        </div>
    </div>

    <div class="container_entrega">
        <div class="form-container">
            <form method="post">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($proveedor['prov_id']); ?>">

                <label class="lbl_form">Nombre</label>
                <input type="text" name="nombre" value="<?php echo htmlspecialchars($proveedor['prov_nombre']); ?>" required>

                <label class="lbl_form">Telefono</label>
                <input type="text" name="tel" value="<?php echo htmlspecialchars($proveedor['prov_tel']); ?>" required>

                <input type="submit" name="actualizar" value="Actualizar">
            </form>
        </div>
    </div>
</body>
</html>

