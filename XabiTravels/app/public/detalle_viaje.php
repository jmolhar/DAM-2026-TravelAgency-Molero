<?php
if (session_status() === PHP_SESSION_NONE) session_start();
include("../config.php");
include("../clases/Viaje.php");

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id_viaje = intval($_GET['id']);
$viajeObj = new Viaje($con);
$viaje = $viajeObj->obtenerPorId($id_viaje);

if (!$viaje) {
    header("Location: index.php");
    exit();
}

$meses = ["Jan"=>"Ene", "Feb"=>"Feb", "Mar"=>"Mar", "Apr"=>"Abr", "May"=>"May", "Jun"=>"Jun", "Jul"=>"Jul", "Aug"=>"Ago", "Sep"=>"Sep", "Oct"=>"Oct", "Nov"=>"Nov", "Dec"=>"Dic"];
$inicio = date("d", strtotime($viaje['fecha_inicio'])) . " " . $meses[date("M", strtotime($viaje['fecha_inicio']))];
$fin = date("d", strtotime($viaje['fecha_fin'])) . " " . $meses[date("M", strtotime($viaje['fecha_fin']))];
$dias = (strtotime($viaje['fecha_fin']) - strtotime($viaje['fecha_inicio'])) / (60 * 60 * 24);

include("../vistas/header.php");
include("../vistas/navbar.php");
?>
<link rel="stylesheet" href="../assets/css/styles.css">
<div class="details-hero" style="background-image: url('../assets/img/<?php echo htmlspecialchars($viaje['imagen']); ?>');">
    <div class="hero-overlay">
        <div class="hero-content">
            <span class="hero-badge"><?php echo htmlspecialchars($viaje['tipo_viaje']); ?></span>
            <h1><?php echo htmlspecialchars($viaje['titulo']); ?></h1>
            <p>
                <?php echo date("d/m/Y", strtotime($viaje['fecha_inicio'])); ?> - <?php echo date("d/m/Y", strtotime($viaje['fecha_fin'])); ?>
                <?php if (!empty($viaje['continente'])) echo " | " . htmlspecialchars($viaje['continente']); ?>
            </p>
        </div>
    </div>
</div>

<div class="content_wrapper">
    <div class="details-grid">
        <div class="details-info">
            <h2 class="section-title">Sobre este viaje</h2>
            <div class="trip-features">
                <div class="feature-item">
                    <span><?php echo intval($dias); ?> Días</span>
                </div>
                <div class="feature-item">
                    <span><?php echo htmlspecialchars($viaje['plazas']); ?> Plazas disponibles</span>
                </div>
            </div>
            <div class="description-text">
                <h3 class="section-title" style="margin-top: 30px;">Descripción del viaje</h3>
                <p><?php echo nl2br(htmlspecialchars($viaje['descripcion'])); ?></p>
            </div>
            <?php if (!empty($viaje['itinerario'])) { ?>
            <div class="itinerary-box" style="margin-top: 30px;">
                <h3 class="section-title">Itinerario</h3>
                <div class="description-text">
                    <p><?php echo nl2br(htmlspecialchars($viaje['itinerario'])); ?></p>
                </div>
            </div>
            <?php } ?>
        </div>

        <div class="details-sidebar">
            <div class="booking-card">
                <div class="price-tag">
                    <span class="price-label">Precio por persona</span>
                    <span class="price-amount"><?php echo number_format($viaje['precio'], 2, ',', '.'); ?> €</span>
                </div>
                <div class="date-selection">
                    <div class="date-row">
                        <div>
                            <strong>Ida:</strong><br>
                            <?php echo $inicio; ?>
                        </div>
                    </div>
                    <div class="date-row">
                        <div>
                            <strong>Vuelta:</strong><br>
                            <?php echo $fin; ?>
                        </div>
                    </div>
                </div>
                <?php if(isset($_SESSION['user_id'])) { ?>
                    <a href="#" class="btn-book-now">SOLICITAR RESERVA</a>
                <?php } else { ?>
                    <a href="login.php" class="btn-book-now btn-disabled">Inicia sesión para reservar</a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php include("../vistas/footer.php"); ?>
