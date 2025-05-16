<?php
include 'db.php';

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener proveedores para el select
$proveedores = mysqli_query($conexion, "SELECT * FROM proveedor");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $idprov = $_POST["prov_id"];
    $fechaE = $_POST["fechaE"];
    $cantidad = $_POST["cantidad"];

    if (!is_numeric($cantidad) || $cantidad <= 0) {
        echo "Cantidad inválida. Debe ser un número positivo.";
        exit;
    }

    $sql = "INSERT INTO producto (produ_nombre, produ_precio, prov_id, fech_entrada, cantidad)
            VALUES ('$nombre', '$precio', '$idprov', '$fechaE', '$cantidad')";

    if ($conexion->query($sql) === TRUE) {
  
        $produ_id = $conexion->insert_id;
        
        $sql_existencias = "INSERT INTO existencias (exis_cantidad, produ_id)
                            VALUES ('$cantidad', '$produ_id')";

        if ($conexion->query($sql_existencias) === TRUE) {
            header("Location: productos.php?mensaje=ok");
            exit;
        } else {
            echo "Error al insertar en existencias: " . $conexion->error;
        }
    } else {
        echo "Error al insertar producto: " . $conexion->error;
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

<body class="fondo-personalizado">
    <div class="barra-superior">
        <div class="menu-btn">
            <button onclick="location.href='menu.php'">≡</button>
        </div>
        <div class="titulo">
            <label><b>CREAR PRODUCTO</b></label>
        </div>
    </div>
    <div class="container_entrega">
        <div class="form-container">
            <form method="post">
                <label class="lbl_form">Ingrese nombre</label>
                <input type="text" name="nombre" required>

                <label class="lbl_form">Ingrese precio</label>
                <input type="text" name="precio" required>

                <label class="lbl_form" for="cantidad">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" min="1" required>

                <label class="lbl_form">Ingrese fecha de entrega</label>
                <input type="date" name="fechaE" required>

                <label class="lbl_form">Seleccione el proveedor</label>
                <select name="prov_id" required>
                    <option value="">Seleccione un proveedor</option>
                    <?php while ($prov = mysqli_fetch_assoc($proveedores)) { ?>
                        <option value="<?= $prov['prov_id'] ?>"><?= $prov['prov_nombre'] ?></option>
                    <?php } ?>
                </select>

                <input type="submit" value="Crear" name="crearprodu">
            </form>

        </div>
    </div>
</body>

</html>