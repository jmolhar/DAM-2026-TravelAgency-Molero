<?php
include("../config.php");
include("../clases/Usuario.php");

$mensaje = "";
if (isset($_POST['btn_registro'])) {
    if ($_POST['password'] === $_POST['confirm_password']) {
        $usuarioObj = new Usuario($con);
        $resultado = $usuarioObj->registrar($_POST['nombre'], $_POST['apellidos'], $_POST['email'], $_POST['password']);

        if ($resultado === true) {
            header("Location: login.php?msg=registrado");
            exit();
        } elseif ($resultado === "email_duplicado") {
            $mensaje = "Ese correo ya está registrado.";
        } else {
            $mensaje = "Error al registrar.";
        }
    } else {
        $mensaje = "Las contraseñas no coinciden.";
    }
}

include("../vistas/header.php");
include("../vistas/navbar.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-box">
            <h2>Crear Cuenta</h2>
            <?php if($mensaje != "") echo "<p style='color:red; margin-bottom:10px;'>$mensaje</p>"; ?>
            <form action="" method="POST" class="auth-form">
                <input type="text" name="nombre" placeholder="Nombre" required>
                <input type="text" name="apellidos" placeholder="Apellidos" required>
                <input type="email" name="email" placeholder="Correo Electrónico" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <input type="password" name="confirm_password" placeholder="Confirmar Contraseña" required>
                <button type="submit" name="btn_registro" class="btn-auth">Registrarse</button>
            </form>
            <div class="auth-footer">
                ¿Ya tienes cuenta? <a href="login.php">Inicia Sesión aquí</a>
            </div>
        </div>
    </div>
<?php include("../vistas/footer.php"); ?>
</body>
</html>
