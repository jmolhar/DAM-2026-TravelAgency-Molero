<?php
include("../config.php");
include("../clases/Viaje.php");

$viajeObj = new Viaje($con);
$lista_destacados = $viajeObj->obtenerDestacados();
$meses = ["Jan"=>"Ene", "Feb"=>"Feb", "Mar"=>"Mar", "Apr"=>"Abr", "May"=>"May", "Jun"=>"Jun", "Jul"=>"Jul", "Aug"=>"Ago", "Sep"=>"Sep", "Oct"=>"Oct", "Nov"=>"Nov", "Dec"=>"Dic"];

include("../vistas/header.php");
include("../vistas/navbar.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Xabi Travels</title>
    <link rel="shortcut icon" href="../assets/img/logoxabitravels.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="content_wrapper">
        <div class="about-section">
            <img src="../assets/img/logoxabitravels.png" alt="Logo Xabi Travels" class="about-logo">
            <div class="about-text">
                <h2>Sobre Nosotros</h2>
                <p>
                    Bienvenido a <strong>Xabi Travels</strong>. La mejor agencia de viajes del pasado 2025 
                    y este 2026 aspiramos a superarnos. Únete a nosotros y disfruta de nuestros viajes por todo el mundo.
                    Tenemos ofertas especiales en viajes a Albacete, Lisboa y próximamente otros destinos. 
                    ¡A que esperas para viajar con nosotros!
                </p>
            </div>
        </div>
        
        <h2 style="text-align:center; color:#003580; margin: 40px 0;">OFERTAS DESTACADAS</h2>
        <div class="trips-grid">
            <?php while($fila = $lista_destacados->fetch()) {
                $inicio = date("d", strtotime($fila['fecha_inicio'])) . " " . $meses[date("M", strtotime($fila['fecha_inicio']))];
                $fin = date("d", strtotime($fila['fecha_fin'])) . " " . $meses[date("M", strtotime($fila['fecha_fin']))];
            ?>
            <a href="detalle_viaje.php?id=<?php echo $fila['id_viaje']; ?>" class="trip-poster-link">
                <div class="trip-poster">
                    <img src="../assets/img/<?php echo $fila['imagen']; ?>" class="poster-bg">
                    <div class="poster-top-bar">
                        <span class="category-badge"><?php echo $fila['tipo_viaje']; ?></span>
                    </div>
                    <div class="poster-content">
                        <h3 class="poster-title"><?php echo $fila['titulo']; ?></h3>
                        <p class="poster-dates"><?php echo $inicio." - ".$fin; ?></p>
                    </div>
                    <div class="poster-bottom-price"><?php echo $fila['precio']; ?> €</div>
                </div>
            </a>
            <?php } ?>
        </div>
    </div>
<?php include("../vistas/footer.php"); ?>
</body>
</html>
