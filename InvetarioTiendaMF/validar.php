<?php
$email = $_POST['email'];
$contraseña = $_POST['contraseña'];
session_start();
$_SESSION['email'] = $email;

$conexion = mysqli_connect("localhost", "root", "", "tallerexamen");

$consulta = "SELECT * FROM login WHERE email='$email' AND contraseña='$contraseña'";
$resultado = mysqli_query($conexion, $consulta);

$filas = mysqli_num_rows($resultado); // Se corrige el parámetro de la función

if ($filas > 0) { // Se valida si hay filas en el resultado
    header("Location: menu.php");
    exit(); // Se agrega la función exit() para detener la ejecución después de redirigir
} else {
    ?>
    <?php
    include("login.php"); // Se corrige la sintaxis del include y se agrega comillas al nombre del archivo
    ?>
    <h1 class="error">ERROR</h1>
    <?php
}

mysqli_free_result($resultado);
mysqli_close($conexion);
?>
