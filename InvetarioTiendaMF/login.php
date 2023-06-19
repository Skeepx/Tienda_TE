<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body background="Imagenes/Iniciarsesion.jpg" style="background-size: cover;">
    <div class="inicioSesion" style="border-radius: 10px;">
        <h1><b>Inicio de sesión</b></h1>
        <form  action="validar.php" method="post">
            <div class="admin">
                <label>Inicie Sesión con su cuenta de <b>administrador</b></label>
            </div>
            <div class="email">
                <input type="text" style="border: 3px solid rgb(113, 22, 199);" name="email" requiered>
                <label>Email</label>
            </div>
            <div class="contraseña">
                <input type="password" style="border: 3px solid rgb(113, 22, 199);" name="contraseña" required>
                <Label>Contraseña</Label>
            </div>
            <input type="submit" value="Iniciar Sersión" > 
            <center>
            <div class="registrarsen">
                ¿No tienes cuenta? <a href="registrarse.php"> <b>Regístrate</b></a>
            </div>
            </center>
        </form>
    </div>    
</body>
</html>