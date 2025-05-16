<?php
include 'db.php';
if (isset($_POST['eliminar'])) {
    $id = $_POST['idprodu'];
    $id = mysqli_real_escape_string($conexion, $id);

    $sqlExistencias = "DELETE FROM existencias WHERE produ_id = $id";
    if ($conexion->query($sqlExistencias) === FALSE) {
        echo "Error al eliminar las filas relacionadas en la tabla existencias: " . $conexion->error;
        exit;
    }

    $sqlProducto = "DELETE FROM producto WHERE produ_id = $id";
    if ($conexion->query($sqlProducto) === TRUE) {
        header("Location: productos.php");
        exit;
    } else {
        echo "Error al eliminar el registro: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="fondo-personalizado">
    <div class="barra-superior">
        <div class="menu-btn">
            <button onclick="location.href='menu.php'">≡</button>
        </div>
        <div class="titulo">
            <label><b>PRODUCTOS</b></label>
        </div>
    </div>

    <div class="acciones">
        <div class="buttons-act">
            <button onclick="location.href='crearprodu.php'">CREAR</button>
            <button onclick="location.href='buscarprodu.php'">BUSCAR</button>
        </div>
    </div>

    <?php
    $sql = "SELECT p.produ_id, p.produ_nombre, p.produ_precio, p.fech_entrada, pr.prov_nombre FROM producto p JOIN proveedor pr ON p.prov_id = pr.prov_id";

    $resultado = $conexion->query($sql);
    ?>
    <div class="table-container">
        <table class="tabla">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Proveedor</th>
                    <th>Fecha Entrada</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $resultado->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($fila['produ_nombre']); ?></td>
                        <td><?php echo htmlspecialchars($fila['produ_precio']); ?></td>
                        <td><?php echo htmlspecialchars($fila['prov_nombre']); ?></td>
                        <td><?php echo htmlspecialchars($fila['fech_entrada']); ?></td>
                        <td>
                            <a href="actualizarprodu.php?id=<?php echo urlencode($fila['produ_id']); ?>">
                                <button class="btn-editar">EDITAR</button>
                            </a>

                            <form method="post" style="display:inline;">
                                <input type="hidden" name="idprodu" value="<?php echo htmlspecialchars($fila['produ_id']); ?>">
                                <button type="submit" name="eliminar" class="btn-eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">ELIMINAR</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>