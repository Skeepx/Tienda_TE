<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = mysqli_real_escape_string($conexion, $_POST['email']);

    $sql = "DELETE FROM login WHERE email = '$email'";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado) {
        session_unset();
        session_destroy();
        header("Location: login.php?eliminado=1");
        exit();
    } else {
        echo "Error al eliminar la cuenta: " . mysqli_error($conexion);
    }
} else {
    header("Location: perfilu.php");
    exit();
}
?>
