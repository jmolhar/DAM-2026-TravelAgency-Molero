<?php
include("auth_check.php");
include("../config.php");
include("../clases/Viaje.php");

$viajeObj = new Viaje($con);
$lista = $viajeObj->obtenerTodos();

include("../vistas/header.php");
include("../vistas/navbar.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Viajes</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="main_wrapper">
        <div class="content_wrapper">
            <div class="admin-panel-wrapper" style="max-width: 1000px;">
                <h2 class="admin-title">Listado de Viajes</h2>
                <table class="admin-list-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Fechas</th>
                            <th>Precio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $lista->fetch()) { ?>
                        <tr>
                            <td>#<?php echo htmlspecialchars($row['id_viaje']); ?></td>
                            <td><?php echo htmlspecialchars($row['titulo']); ?></td>
                            <td><?php echo date("d/m/Y", strtotime($row['fecha_inicio'])); ?></td>
                            <td><?php echo number_format($row['precio'], 2, ',', '.'); ?> €</td>
                            <td>
                                <a href="editar_viaje.php?id=<?php echo htmlspecialchars($row['id_viaje']); ?>" class="btn-action btn-edit">Modificar</a>
                                <a href="borrar_viaje.php?id=<?php echo htmlspecialchars($row['id_viaje']); ?>" class="btn-action btn-delete" onclick="return confirm('¿Seguro que quieres borrar?');">Eliminar</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div style="text-align: right; margin-top: 20px;">
                    <a href="viajes.php" class="btn-save" style="width: auto; display: inline-block;">Nuevo Viaje</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
