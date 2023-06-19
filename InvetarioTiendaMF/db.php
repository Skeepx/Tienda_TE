<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "tallerexamen";

// Crear una conexión
$conexion = new mysqli($servername, $username, $password, $database);

// Verificar si hay errores en la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}else{
    echo"ingreso exitoso";
}

// Cerrar la conexión
$conexion->close();
?>
