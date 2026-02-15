<?php
session_start();
include("../config.php");
include("../clases/Usuario.php");

$mensaje = "";
if(isset($_GET['msg']) && $_GET['msg']=='registrado') {
    $mensaje = "<span style='color:green'>¡Registro exitoso! Inicia sesión.</span>";
}

if (isset($_POST['btn_login'])) {
    $usuarioObj = new Usuario($con);
    $datos_usuario = $usuarioObj->login($_POST['email'], $_POST['password']);

    if ($datos_usuario) {
        $_SESSION['user_id'] = $datos_usuario['id_usuario'];
        $_SESSION['user_name'] = $datos_usuario['nombre'];
        $_SESSION['es_admin'] = $datos_usuario['es_admin'];
        header("Location: " . ($datos_usuario['es_admin'] == 1 ? "../admin/ver_viajes.php" : "index.php"));
        exit();
    } else {
        $mensaje = "<span style='color:red'>Correo o contraseña incorrectos.</span>";
    }
}

include("../vistas/header.php");
include("../vistas/navbar.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-box">
            <h2>Iniciar Sesión</h2>
            <?php if($mensaje != "") echo "<p style='margin-bottom:15px;'>$mensaje</p>"; ?>
            <form action="" method="POST" class="auth-form">
                <input type="email" name="email" placeholder="Correo Electrónico" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <button type="submit" name="btn_login" class="btn-auth">Entrar</button>
            </form>
            <div class="auth-footer">
                ¿No tienes cuenta? <a href="registro.php">Regístrate gratis</a>
            </div>
        </div>
    </div>
<?php include("../vistas/footer.php"); ?>
</body>
</html>
