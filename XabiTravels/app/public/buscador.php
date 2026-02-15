<?php
include("../config.php");
include("../clases/Viaje.php");

$viajeObj = new Viaje($con);
$meses = ["Jan"=>"Ene", "Feb"=>"Feb", "Mar"=>"Mar", "Apr"=>"Abr", "May"=>"May", "Jun"=>"Jun", "Jul"=>"Jul", "Aug"=>"Ago", "Sep"=>"Sep", "Oct"=>"Oct", "Nov"=>"Nov", "Dec"=>"Dic"];

$tipo = $_GET['tipo'] ?? '';
$continente = $_GET['continente'] ?? '';
$f_inicio = $_GET['f_inicio'] ?? '';
$f_fin = $_GET['f_fin'] ?? '';

$resultados = $viajeObj->obtenerFiltrados($tipo, $continente, $f_inicio, $f_fin);
$total = $resultados->rowCount();

include("../vistas/header.php");
include("../vistas/navbar.php");
?>
<div class="content_wrapper" style="min-height: 80vh;">
    <div style="text-align: center; margin: 50px 0 30px;">
        <h2 style="color:#003580; margin-bottom: 15px; font-weight:800;">RESULTADOS DE BÚSQUEDA</h2>
        <div display: inline-block; padding: 10px 20px;">
            <?php if($total > 0): ?>
            <?php else: ?>
                No hemos encontrado viajes con esos filtros.
            <?php endif; ?>
        </div>
    </div>

    <?php if($total > 0) { ?>
        <div class="trips-grid">
            <?php while($fila = $resultados->fetch()) {
                $inicio = date("d", strtotime($fila['fecha_inicio'])) . " " . $meses[date("M", strtotime($fila['fecha_inicio']))];
                $fin = date("d", strtotime($fila['fecha_fin'])) . " " . $meses[date("M", strtotime($fila['fecha_fin']))];
                $dias = (strtotime($fila['fecha_fin']) - strtotime($fila['fecha_inicio'])) / (60 * 60 * 24);
            ?>
            <a href="detalle_viaje.php?id=<?php echo $fila['id_viaje']; ?>" class="trip-poster-link">
                <div class="trip-poster">
                    <img src="../assets/img/<?php echo $fila['imagen']; ?>" class="poster-bg">
                    <div class="poster-top-bar">
                        <span class="category-badge"><?php echo $fila['tipo_viaje']; ?></span>
                    </div>
                    <div class="poster-content">
                        <h3 class="poster-title"><?php echo $fila['titulo']; ?></h3>
                        <p class="poster-dates"><?php echo intval($dias); ?> días | <?php echo $inicio." - ".$fin; ?></p>
                    </div>
                    <div class="poster-bottom-price"><?php echo $fila['precio']; ?> €</div>
                </div>
            </a>
            <?php } ?>
        </div>
    <?php } else { ?>
        <div style="text-align:center; padding: 60px 20px;">
            <a href="index.php" class="nav-btn-register" style="display:inline-block; width:auto;">Ver todos los viajes</a>
        </div>
    <?php } ?>
</div>
<?php include("../vistas/footer.php"); ?>
