<?php
include 'db.php';

$tableProductos = '';

if (isset($_POST['buscar'])) {
    $id = $_POST['id'];
    $id = mysqli_real_escape_string($conexion, $id);

    $sqlProductos = "
        SELECT producto.*, proveedor.prov_nombre 
        FROM producto 
        JOIN proveedor ON producto.prov_id = proveedor.prov_id 
        WHERE producto.produ_id = $id
    ";
    $resultProductos = $conexion->query($sqlProductos);

    if ($resultProductos->num_rows > 0) {
        $rowProductos = $resultProductos->fetch_assoc();

        $tableProductos .= '<div class="cuadro-buscar">';
        $tableProductos .= '<p><strong>ID:</strong> ' . $rowProductos['produ_id'] . '</p>';
        $tableProductos .= '<p><strong>Nombre:</strong> ' . $rowProductos['produ_nombre'] . '</p>';
        $tableProductos .= '<p><strong>Precio:</strong> ' . $rowProductos['produ_precio'] . '</p>';
        $tableProductos .= '<p><strong>Proveedor:</strong> ' . $rowProductos['prov_nombre'] . '</p>';
        $tableProductos .= '<p><strong>Fecha Entrada:</strong> ' . $rowProductos['fech_entrada'] . '</p>';
        $tableProductos .= '</div>';
    } else {
        $tableProductos = "<p class='mensaje-error'>No se encontró ningún producto.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar producto</title>
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
            <label><b>BUSCAR PRODUCTO</b></label>
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
                <?php echo $tableProductos; ?>
            </div>
        </div>
    </div>
</body>
</html>
