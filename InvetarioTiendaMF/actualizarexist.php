<?php
include 'db.php';

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $id = mysqli_real_escape_string($conexion, $id);

    $sql = "SELECT existencias.exis_id, existencias.exis_cantidad, producto.produ_nombre, producto.produ_id
            FROM existencias
            INNER JOIN producto ON existencias.produ_id = producto.produ_id
            WHERE exis_id = $id";

    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
    } else {
        die("Existencia no encontrada.");
    }
} else {
    die("ID de existencia no especificado.");
}

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
    <title>Actualizar existencias</title>
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
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($fila['exis_id']); ?>">
                <input type="hidden" name="prodid" value="<?php echo htmlspecialchars($fila['produ_id']); ?>">

                <label class="lbl_form">Producto:</label>
                <input type="text" value="<?php echo htmlspecialchars($fila['produ_nombre']); ?>" disabled>

                <label class="lbl_form" for="cantidad">Cantidad:</label>
                <input type="number" name="cantidad" id="cantidad" min="1" required value="<?php echo htmlspecialchars($fila['exis_cantidad']); ?>">

                <input type="submit" value="Actualizar" name="actualizar">
            </form>

        </div>
    </div>
</body>