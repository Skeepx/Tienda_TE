<?php
include 'db.php';

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$proveedores = $conexion->query("SELECT prov_id, prov_nombre FROM proveedor");

$tableProveedor = '';

if (isset($_POST['buscar'])) {
    $id = $_POST['id'];
    $id = mysqli_real_escape_string($conexion, $id);

    $sqlProveedor = "SELECT * FROM proveedor WHERE prov_id = $id";
    $resultProveedor = $conexion->query($sqlProveedor);

    if ($resultProveedor->num_rows > 0) {
    $rowProveedor = $resultProveedor->fetch_assoc();

    $tableProveedor .= '<div class="cuadro-buscar">';
    $tableProveedor .= '<p><strong>ID:</strong> ' . $rowProveedor['prov_id'] . '</p>';
    $tableProveedor .= '<p><strong>Nombre:</strong> ' . $rowProveedor['prov_nombre'] . '</p>';
    $tableProveedor .= '<p><strong>Teléfono:</strong> ' . $rowProveedor['prov_tel'] . '</p>';
    $tableProveedor .= '</div>';
} else {
    $tableProveedor = "<p class='mensaje-error'>No se encontró ningún proveedor.</p>";
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Seleccione un proveedor",
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
            <label><b>BUSCAR PROVEEDOR</b></label>
        </div>
    </div>
        <div class="container_entrega">
            <div class="form-container">
                <?php
                include 'db.php';
                $proveedores = mysqli_query($conexion, "SELECT * FROM proveedor");
                ?>
                <div class="table-container">
                    <form method="post">
                        <label for="proveedor">Seleccione un proveedor:</label>
                        <select name="id" id="proveedor" class="select2" required>
                            <option value="">Seleccione un proveedor</option>
                            <?php while ($prov = mysqli_fetch_assoc($proveedores)) { ?>
                                <option value="<?= $prov['prov_id'] ?>"><?= $prov['prov_nombre'] ?></option>
                            <?php } ?>
                        </select>
                        <input type="submit" name="buscar" value="Buscar">
                    </form>
                    <?php echo $tableProveedor; ?>
                </div>
            </div>
        
    </div>
</body>

</html>