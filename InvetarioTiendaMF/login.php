<?php if (isset($_GET['eliminado'])): ?>
    <p class="mensaje-exito">Tu cuenta ha sido eliminada exitosamente.</p>
<?php endif; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login">
        <div class="login-container">
            <div class="login-form">
                
                <h2>Inicio de sesión</h2>
                <p>¿No tienes una cuenta? <a href="registrarse.php">Regístrate</a></p>

                <form action="validar.php" method="post">

                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="you@example.com" required>
                    </div>

                    <div class="input-group password-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="contraseña" placeholder="Mínimo 6 caracteres" required>
                    </div>

                    <button type="submit" class="btn-login">Iniciar sesión</button>

                    <div class="or">o inicia sesión con</div>

                    <div class="social-login">
                        <button type="button" class="google-btn">Google</button>
                        <button type="button" class="facebook-btn">Facebook</button>
                    </div>

                </form>

            </div>

            <div class="login-image">
                <img src="Imagenes/Iniciarsesion.jpg" alt="Imagen de login">
            </div>
        </div>
    </div>
</body>

</html>