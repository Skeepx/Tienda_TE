<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores</title>
    <link rel="stylesheet" href="style.css">
</head>
<body background="Imagenes/caja.jpg" style="background-size: cover;">

    <div class="crear" style="border-radius: 10px;" >
        <button onclick="location.href='crearprov.php'"><b>CREAR</b></button>
    </div>
    <div class="actualizar" style="border-radius: 10px;">
        <button onclick="location.href='actualizarprov.php'"><b>ACTUALIZAR</b></button>
    </div>
    <div class="eliminar" style="border-radius: 10px;">
        <button onclick="location.href='eliminarprov.php'"><b>ELIMINIAR</b></button>
    </div>
    <div class="buscarex" style="border-radius: 10px;">
        <button onclick="location.href='buscarprovee.php'"><b>BUSCAR</b></button>
    </div>
    <div class="menprovee" style="border-radius: 10px;">
        <button onclick="location.href='menu.php'"><b>=</b></button>
    </div>
    <div class="prov" style="border-radius: 10px;">
        <label><b>PROVEEDORES</b></label>
    </div>

    <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "tallerexamen";
    $conexion = new mysqli($servername, $username, $password, $database);

    $sql = "SELECT * FROM proveedor";
    $resultado = $conexion->query($sql);
    ?>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Dirección</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($fila = $resultado->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $fila['prov_id']; ?></td>
                <td><?php echo $fila['prov_nombre']; ?></td>
                <td><?php echo $fila['prov_direc']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
    </table>

</body>
</html>