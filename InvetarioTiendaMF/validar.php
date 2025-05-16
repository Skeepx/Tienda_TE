<?php
    include 'db.php';

    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];
    session_start();

    $consulta = "SELECT * FROM login WHERE email='$email' AND contraseña='$contraseña'";
    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);

        $_SESSION['email'] = $fila['email'];
        $_SESSION['nombre'] = $fila['nombre']; 

        header("Location: menu.php");
        exit();
    } else {
        include("login.php");
        echo '<h1 class="error">ERROR</h1>';
    }

    mysqli_free_result($resultado);
    mysqli_close($conexion);
?>