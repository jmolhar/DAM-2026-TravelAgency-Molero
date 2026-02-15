<?php
include("auth_check.php");
include("../config.php");
include("../clases/Viaje.php");
include("../vistas/header.php");

$mensaje = "";
if (isset($_POST['btn_crear'])) {
    $titulo = trim($_POST['titulo']);
    $descripcion = trim($_POST['descripcion']);
    $continente = trim($_POST['continente'] ?? '');
    $itinerario = trim($_POST['itinerario'] ?? '');
    $precio = floatval($_POST['precio']);
    $plazas = intval($_POST['plazas']);
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $tipo_viaje = $_POST['tipo'];
    $destacado = isset($_POST['destacado']) ? 1 : 0;

    if (empty($titulo) || empty($descripcion) || $precio <= 0 || $plazas <= 0) {
        $mensaje = "<div class='alert error'>Por favor, completa todos los campos correctamente.</div>";
    } else {
        $nombre_imagen = "default.jpg";
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $nombre_imagen = basename($_FILES['imagen']['name']);
            $ruta_destino = "../assets/img/" . $nombre_imagen;
            if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino)) {
                $mensaje = "<div class='alert error'>Error al subir la imagen.</div>";
            }
        }

        if (empty($mensaje)) {
            $viajeObj = new Viaje($con);
            if ($viajeObj->crear($titulo, $descripcion, $fecha_inicio, $fecha_fin, $precio, $destacado, $tipo_viaje, $plazas, $nombre_imagen, $continente, $itinerario)) {
                header("Location: ver_viajes.php");
                exit();
            } else {
                $mensaje = "<div class='alert error'>Error al crear el viaje.</div>";
            }
        }
    }
}
?>
<link rel="stylesheet" href="../assets/css/styles.css">
<div class="admin-wrapper">
    <div class="admin-form-container">
        <h2>Crear Nuevo Viaje</h2>
        <?php echo $mensaje; ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Título del Viaje</label>
                <input type="text" name="titulo" placeholder="Ej: Aventura en los Andes" required maxlength="255">
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label>Continente</label>
                    <select name="continente" required>
                        <option value="">Seleccione un continente</option>
                        <option value="Europa">Europa</option>
                        <option value="Asia">Asia</option>
                        <option value="America">América</option>
                        <option value="Africa">África</option>
                        <option value="Oceania">Oceanía</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tipo de Viaje</label>
                    <select name="tipo" required>
                        <option value="Aventura">Aventura</option>
                        <option value="Relax">Relax</option>
                        <option value="Cultural">Cultural</option>
                        <option value="Romantico">Romántico</option>
                        <option value="Gastronomico">Gastronómico</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Descripción del Viaje</label>
                <textarea name="descripcion" rows="4" placeholder="Describe el viaje, qué incluye, qué verás..." required></textarea>
            </div>

            <div class="form-group">
                <label>Itinerario</label>
                <textarea name="itinerario" rows="8" placeholder="Día 1: Salimos de Granada a...&#10;Día 2: Visita a..."></textarea>
            </div>

            <div class="form-grid-3">
                <div class="form-group">
                    <label>Fecha Inicio</label>
                    <input type="date" name="fecha_inicio" required>
                </div>
                <div class="form-group">
                    <label>Fecha Fin</label>
                    <input type="date" name="fecha_fin" required>
                </div>
                <div class="form-group">
                    <label>Precio (€)</label>
                    <input type="number" name="precio" placeholder="1500" required min="0" step="0.01">
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label>Plazas Disponibles</label>
                    <input type="number" name="plazas" value="20" required min="1">
                </div>
                <div class="form-group">
                    <label style="display: block; margin-bottom: 8px; color: #333; font-size: 14px;">Opciones</label>
                    <div class="checkbox-frame">
                        <label>
                            <input type="checkbox" name="destacado" value="1"> 
                            ¿Mostrar en Destacados?
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Imagen de Portada</label>
                <input type="file" name="imagen" required accept="image/jpeg,image/jpg,image/png,image/webp,image/gif">
            </div>

            <button type="submit" name="btn_crear" class="btn-admin-save">Guardar Viaje</button>
            <a href="ver_viajes.php" class="btn-admin-cancel">Cancelar</a>
        </form>
    </div>
</div>
</body></html>
