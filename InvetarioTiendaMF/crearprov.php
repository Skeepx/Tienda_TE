<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db.php';
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $nombre = $_POST["nombre"];
    $telefono = $_POST["tel"];

    $sql = "INSERT INTO proveedor (prov_nombre, prov_tel) VALUES ('$nombre', '$telefono')";

    if ($conexion->query($sql) === TRUE) {
        header("Location: proveedores.php");
            exit;
    } else {
        echo "Error al insertar datos: " . $conexion->error;
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
    <title>Crear proveedor</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="fondo-personalizado">
    <div class="barra-superior">
        <div class="menu-btn">
            <button onclick="location.href='menu.php'">≡</button>
        </div>
        <div class="titulo">
            <label><b>CREAR PROVEEDOR</b></label>
        </div>
    </div>
    <div class="container_entrega">
        <div class="form-container">
            <form method="post">
                <label class="lbl_form">Ingrese nombre</label>
                <input type="text" name="nombre" required>

                <label class="lbl_form">Ingrese telefono</label>
                <input type="text" name="tel" required>

                <input type="submit" value="Crear" name="crearprov">
            </form>

        </div>
    </div>
</body>
</html>
