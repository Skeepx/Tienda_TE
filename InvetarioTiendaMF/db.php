<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "tallerexamen";

    $conexion = new mysqli($servername, $username, $password, $database);

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
?>
