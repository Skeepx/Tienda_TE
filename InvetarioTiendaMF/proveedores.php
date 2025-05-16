<?php
    include 'db.php';
    if (isset($_POST['eliminar'])) {
        $id = $_POST['id'];
        $id = mysqli_real_escape_string($conexion, $id);

        $sql = "DELETE FROM proveedor WHERE prov_id = $id";

        if ($conexion->query($sql) === TRUE) {
            header("Location: proveedores.php");
            exit;
        } else {
            echo "Error al eliminar el registro: " . $conexion->error;
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="fondo-personalizado">
    <div class="barra-superior">
        <div class="menu-btn">
            <button onclick="location.href='menu.php'">≡</button>
        </div>
        <div class="titulo">
            <label><b>PROVEEDORES</b></label>
        </div>
    </div>

    <div class="acciones">
        <div class="buttons-act">
            <button onclick="location.href='crearprov.php'">CREAR</button>
            <button onclick="location.href='buscarprovee.php'">BUSCAR</button>
        </div>
    </div>

    <?php
    $sql = "SELECT * FROM proveedor";
    $resultado = $conexion->query($sql);
    ?>
    <div class="table-container">
        <table class="tabla">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $resultado->fetch_assoc()) { ?>
                    <tr>
                        <td><?= htmlspecialchars($fila['prov_nombre']) ?></td>
                        <td><?= htmlspecialchars($fila['prov_tel']) ?></td>
                        <td>
                            <a href="actualizarprov.php?id=<?php echo urlencode($fila['prov_id']); ?>">
                                <button class="btn-editar">EDITAR</button>
                            </a>

                            <form method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($fila['prov_id']); ?>">
                                <button type="submit" name="eliminar" class="btn-eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este proveedor?');">ELIMINAR</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>