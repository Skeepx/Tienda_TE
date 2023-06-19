<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Existencias</title>
    <link rel="stylesheet" href="style.css">
</head>
<body background="Imagenes/caja.jpg" style="background-size: cover;">

    <div class="crearex" style="border-radius: 10px;" >
        <button onclick="location.href='crearexist.php'"><b>CREAR</b></button>
    </div>
    <div class="actualizarex" style="border-radius: 10px;">
        <button onclick="location.href='actualizarexist.php'"><b>ACTUALIZAR</b></button>
    </div>
    <div class="eliminarex" style="border-radius: 10px;">
        <button onclick="location.href='eliminarexis.php'"><b>ELIMINIAR</b></button>
    </div>
    <div class="buscarex" style="border-radius: 10px;">
        <button onclick="location.href='buscarexis.php'"><b>BUSCAR</b></button>
    </div>
    <div class="menex" style="border-radius: 10px;">
        <button onclick="location.href='menu.php'"><b>=</b></button>
    </div>
    <div class="existe" style="border-radius: 10px;">
        <label><b>EXISTENCIAS</b></label>
    </div>
</body>
</html>
<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "tallerexamen";
    $conexion = new mysqli($servername, $username, $password, $database);

    $sql = "SELECT * FROM existencias";
    $resultado = $conexion->query($sql);
    ?>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cantidad</th>
                <th>ID Producto</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($fila = $resultado->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $fila['exis_id']; ?></td>
                <td><?php echo $fila['exis_cantidad']; ?></td>
                <td><?php echo $fila['produ_id']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
    </table>

</body>
</html>