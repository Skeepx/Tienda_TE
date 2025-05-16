<?php
include 'db.php';
if (isset($_POST['eliminar'])) {
    $id = $_POST['idexis'];
    $id = mysqli_real_escape_string($conexion, $id);

    $sqlExistencias = "DELETE FROM existencias WHERE exis_id = $id";
    if ($conexion->query($sqlExistencias) === TRUE) {
        header("Location: existencias.php");
        exit;
    } else {
        echo "Error al eliminar el registro: " . $conexion->error;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Existencias</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="fondo-personalizado">
    <div class="barra-superior">
        <div class="menu-btn">
            <button onclick="location.href='menu.php'">≡</button>
        </div>
        <div class="titulo">
            <label><b>EXISTENCIAS</b></label>
        </div>
    </div>

    <div class="acciones">
        <div class="buttons-act">
            <button onclick="location.href='buscarexis.php'">BUSCAR</button>
        </div>
    </div>

    <?php
    $sql = "SELECT e.exis_id, e.exis_cantidad, p.produ_nombre FROM existencias e JOIN producto p ON e.produ_id = p.produ_id";

    $resultado = $conexion->query($sql);
    ?>
    <div class="table-container">
        <table class="tabla">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $resultado->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($fila['produ_nombre']); ?></td>
                        <td><?php echo htmlspecialchars($fila['exis_cantidad']); ?></td>

                        <td>
                            <a href="actualizarexist.php?id=<?php echo urlencode($fila['exis_id']); ?>">
                                <button class="btn-editar">Editar</button>
                            </a>

                            <form method="post" style="display:inline;">
                                <input type="hidden" name="idexis" value="<?php echo htmlspecialchars($fila['exis_id']); ?>">
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