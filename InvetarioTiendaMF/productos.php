<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body background="Imagenes/caja.jpg" style="background-size: cover;">

    <div class="crearprod" style="border-radius: 10px;" >
        <button onclick="location.href='crearprodu.php'"><b>CREAR</b></button>
    </div>
    <div class="actualizarprod" style="border-radius: 10px;">
        <button onclick="location.href='actualizarprodu.php'"><b>ACTUALIZAR</b></button>
    </div>
    <div class="eliminarprod" style="border-radius: 10px;">
        <button onclick="location.href='eliminarprodu.php'"><b>ELIMINIAR</b></button>
    </div>
    <div class="buscarex" style="border-radius: 10px;">
        <button onclick="location.href='buscarprodu.php'"><b>BUSCAR</b></button>
    </div>
    <div class="menprod" style="border-radius: 10px;">
        <button onclick="location.href='menu.php'"><b>=</b></button>
    </div>
    <div class="prod" style="border-radius: 10px;">
        <label><b>PRODUCTOS</b></label>
    </div>
    <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "tallerexamen";
    $conexion = new mysqli($servername, $username, $password, $database);

    $sql = "SELECT * FROM producto";
    $resultado = $conexion->query($sql);
    ?>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>ID Provee</th>
                <th>Fecha Entrada</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($fila = $resultado->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $fila['produ_id']; ?></td>
                <td><?php echo $fila['produ_nombre']; ?></td>
                <td><?php echo $fila['produ_precio']; ?></td>
                <td><?php echo $fila['prov_id']; ?></td>
                <td><?php echo $fila['fech_entrada']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
    </table>

</body>
</html>
</body>
</html>