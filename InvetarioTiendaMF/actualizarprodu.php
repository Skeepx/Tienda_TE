<?php
include 'db.php';

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $id = mysqli_real_escape_string($conexion, $id);

    $sql = "SELECT * FROM producto WHERE produ_id = $id";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
    } else {
        die("Producto no encontrado.");
    }
} else {
    die("ID de producto no especificado.");
}

$proveedores = mysqli_query($conexion, "SELECT * FROM proveedor");

if (isset($_POST['actualizar'])) {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $precio = mysqli_real_escape_string($conexion, $_POST['precio']);
    $cantidad = mysqli_real_escape_string($conexion, $_POST['cantidad']);
    $fechaE = mysqli_real_escape_string($conexion, $_POST['fechaE']);
    $idprov = mysqli_real_escape_string($conexion, $_POST['prov_id']);

    $sql = "UPDATE producto SET produ_nombre = '$nombre', produ_precio = '$precio', prov_id = '$idprov', fech_entrada = '$fechaE', cantidad = $cantidad WHERE produ_id = $id";

    if ($conexion->query($sql) === TRUE) {
        $updateExistencia = "UPDATE existencias SET exis_cantidad = $cantidad WHERE produ_id = $id";
        $conexion->query($updateExistencia);

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

<body class="fondo-personalizado">
    <div class="barra-superior">
        <div class="menu-btn">
            <button onclick="location.href='menu.php'">≡</button>
        </div>
        <div class="titulo">
            <label><b>ACTUALIZAR PRODUCTO</b></label>
        </div>
    </div>
    <div class="container_entrega">
        <div class="form-container">
            <form method="post">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($fila['produ_id']); ?>">

                <label class="lbl_form">Ingrese nombre</label>
                <input type="text" name="nombre" required value="<?php echo htmlspecialchars($fila['produ_nombre']); ?>">

                <label class="lbl_form">Ingrese precio</label>
                <input type="text" name="precio" required value="<?php echo htmlspecialchars($fila['produ_precio']); ?>">

                <label class="lbl_form" for="cantidad">Cantidad:</label>
                <input type="number" name="cantidad" id="cantidad" min="1" required value="<?php echo htmlspecialchars($fila['cantidad']); ?>">

                <label class="lbl_form">Ingrese fecha de entrega</label>
                <input type="date" name="fechaE" required value="<?php echo htmlspecialchars($fila['fech_entrada']); ?>">

                <label class="lbl_form">Seleccione el proveedor</label>
                <select name="prov_id" required>
                    <option value="">Seleccione un proveedor</option>
                    <?php while ($prov = mysqli_fetch_assoc($proveedores)) { ?>
                        <option value="<?= $prov['prov_id'] ?>" <?= ($prov['prov_id'] == $fila['prov_id']) ? 'selected' : '' ?>><?= $prov['prov_nombre'] ?></option>
                    <?php } ?>
                </select>

                <input type="submit" value="Actualizar" name="actualizar">
            </form>
        </div>
    </div>
</body>

</html>