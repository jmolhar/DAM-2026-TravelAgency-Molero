<?php
include("auth_check.php");
include("../config.php");
include("../clases/Viaje.php");
include("../vistas/header.php");

if (!isset($_GET['id'])) {
    header("Location: ver_viajes.php");
    exit();
}
$id = intval($_GET['id']);

$mensaje = "";
if (isset($_POST['btn_actualizar'])) {
    $titulo = trim($_POST['titulo']);
    $descripcion = trim($_POST['descripcion']);
    $continente = trim($_POST['continente'] ?? '');
    $itinerario = trim($_POST['itinerario'] ?? '');
    $precio = floatval($_POST['precio']);
    $plazas = intval($_POST['plazas']);
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $tipo = $_POST['tipo'];
    $destacado = isset($_POST['destacado']) ? 1 : 0;

    if (empty($titulo) || empty($descripcion) || $precio <= 0 || $plazas <= 0) {
        $mensaje = "<div class='alert error'>Por favor, completa todos los campos correctamente.</div>";
    } else {
        $imagen = $_POST['imagen_actual'];
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $nombre_imagen = basename($_FILES['imagen']['name']);
            $ruta_destino = "../assets/img/" . $nombre_imagen;
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino)) {
                $imagen = $nombre_imagen;
            } else {
                $mensaje = "<div class='alert error'>Error al subir la imagen.</div>";
            }
        }

        if (empty($mensaje)) {
            $viajeObj = new Viaje($con);
            if ($viajeObj->actualizar($id, $titulo, $descripcion, $fecha_inicio, $fecha_fin, $precio, $destacado, $tipo, $plazas, $imagen, $continente, null, $itinerario)) {
                header("Location: ver_viajes.php");
                exit();
            } else {
                $mensaje = "<div class='alert error'>Error al actualizar.</div>";
            }
        }
    }
}

$viajeObj = new Viaje($con);
$fila = $viajeObj->obtenerPorId($id);

if (!$fila) {
    header("Location: ver_viajes.php");
    exit();
}
?>
<link rel="stylesheet" href="../assets/css/styles.css">
<div class="admin-wrapper">
    <div class="admin-form-container">
        <h2>Editar Viaje: <?php echo htmlspecialchars($fila['titulo']); ?></h2>
        <?php echo $mensaje; ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Título del Viaje</label>
                <input type="text" name="titulo" value="<?php echo htmlspecialchars($fila['titulo']); ?>" required maxlength="255">
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label>Continente</label>
                    <select name="continente" required>
                        <option value="">Seleccione un continente</option>
                        <option value="Europa" <?php if(($fila['continente'] ?? '')=='Europa') echo 'selected'; ?>>Europa</option>
                        <option value="Asia" <?php if(($fila['continente'] ?? '')=='Asia') echo 'selected'; ?>>Asia</option>
                        <option value="America" <?php if(($fila['continente'] ?? '')=='America') echo 'selected'; ?>>América</option>
                        <option value="Africa" <?php if(($fila['continente'] ?? '')=='Africa') echo 'selected'; ?>>África</option>
                        <option value="Oceania" <?php if(($fila['continente'] ?? '')=='Oceania') echo 'selected'; ?>>Oceanía</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tipo de Viaje</label>
                    <select name="tipo" required>
                        <option value="Aventura" <?php if($fila['tipo_viaje']=='Aventura') echo 'selected'; ?>>Aventura</option>
                        <option value="Relax" <?php if($fila['tipo_viaje']=='Relax') echo 'selected'; ?>>Relax</option>
                        <option value="Cultural" <?php if($fila['tipo_viaje']=='Cultural') echo 'selected'; ?>>Cultural</option>
                        <option value="Romantico" <?php if($fila['tipo_viaje']=='Romantico') echo 'selected'; ?>>Romántico</option>
                        <option value="Gastronomico" <?php if($fila['tipo_viaje']=='Gastronomico') echo 'selected'; ?>>Gastronómico</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Descripción del Viaje</label>
                <textarea name="descripcion" rows="4" required><?php echo htmlspecialchars($fila['descripcion'] ?? ''); ?></textarea>
            </div>

            <div class="form-group">
                <label>Itinerario</label>
                <textarea name="itinerario" rows="8" placeholder="Día 1: Llegada a...&#10;Día 2: Visita a...&#10;Día 3: Excursión a..."><?php echo htmlspecialchars($fila['itinerario'] ?? ''); ?></textarea>
            </div>

            <div class="form-grid-3">
                <div class="form-group">
                    <label>Fecha Inicio</label>
                    <input type="date" name="fecha_inicio" value="<?php echo htmlspecialchars($fila['fecha_inicio']); ?>" required>
                </div>
                <div class="form-group">
                    <label>Fecha Fin</label>
                    <input type="date" name="fecha_fin" value="<?php echo htmlspecialchars($fila['fecha_fin']); ?>" required>
                </div>
                <div class="form-group">
                    <label>Precio (€)</label>
                    <input type="number" name="precio" value="<?php echo htmlspecialchars($fila['precio']); ?>" required min="0" step="0.01">
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label>Plazas Disponibles</label>
                    <input type="number" name="plazas" value="<?php echo $fila['plazas']; ?>" required min="1">
                </div>
                <div class="form-group">
                    <label style="display: block; margin-bottom: 8px; color: #333; font-size: 14px;">Opciones</label>
                    <div class="checkbox-frame">
                        <label>
                            <input type="checkbox" name="destacado" value="1" <?php if($fila['destacado']==1) echo 'checked'; ?>> 
                            ¿Mostrar en Destacados?
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Imagen</label>
                <input type="file" name="imagen" accept="image/jpeg,image/jpg,image/png,image/webp,image/gif">
                <input type="hidden" name="imagen_actual" value="<?php echo htmlspecialchars($fila['imagen']); ?>">
                <p style="font-size:12px; margin-top:5px;">Actual: <?php echo htmlspecialchars($fila['imagen']); ?></p>
            </div>

            <button type="submit" name="btn_actualizar" class="btn-admin-save">Actualizar Viaje</button>
            <a href="ver_viajes.php" class="btn-admin-cancel">Volver</a>
        </form>
    </div>
</div>
</body></html>
