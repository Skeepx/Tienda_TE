<?php
include 'db.php';

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$tableExistencia = '';

if (isset($_POST['buscar'])) {
    $id = $_POST['id'];
    $id = mysqli_real_escape_string($conexion, $id);

    $sqlExistencia = "
        SELECT e.exis_id, e.exis_cantidad, p.produ_nombre 
        FROM existencias e
        JOIN producto p ON e.produ_id = p.produ_id
        WHERE e.produ_id = $id
    ";
    $resultExistencia = $conexion->query($sqlExistencia);

    if ($resultExistencia->num_rows > 0) {
        while ($row = $resultExistencia->fetch_assoc()) {
            $tableExistencia .= '<div class="cuadro-buscar">';
            $tableExistencia .= '<p><strong>ID de la existencia:</strong> ' . $row['exis_id'] . '</p>';
            $tableExistencia .= '<p><strong>Nombre del Producto:</strong> ' . $row['produ_nombre'] . '</p>';
            $tableExistencia .= '<p><strong>Cantidad:</strong> ' . $row['exis_cantidad'] . '</p>';
            $tableExistencia .= '</div>';
        }
    } else {
        $tableExistencia = "<p class='mensaje-error'>No se encontraron existencias para este producto.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar existencia por producto</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Seleccione un producto",
            allowClear: true,
            width: '100%'
        });
    });
</script>
<body class="fondo-personalizado">
    <div class="barra-superior">
        <div class="menu-btn">
            <button onclick="location.href='menu.php'">≡</button>
        </div>
        <div class="titulo">
            <label><b>BUSCAR EXISTENCIA</b></label>
        </div>
    </div>

    <div class="container_entrega">
        <div class="form-container">
            <?php
            $productos = mysqli_query($conexion, "SELECT * FROM producto");
            ?>
            <div class="table-container">
                <form method="post">
                    <label for="producto">Seleccione un producto:</label>
                    <select name="id" id="producto" class="select2" required>
                        <option value="">Seleccione un producto</option>
                        <?php while ($prod = mysqli_fetch_assoc($productos)) { ?>
                            <option value="<?= $prod['produ_id'] ?>"><?= $prod['produ_nombre'] ?></option>
                        <?php } ?>
                    </select>
                    <input type="submit" name="buscar" value="Buscar">
                </form>
                <?php echo $tableExistencia; ?>
            </div>
        </div>
    </div>
</body>
</html>
