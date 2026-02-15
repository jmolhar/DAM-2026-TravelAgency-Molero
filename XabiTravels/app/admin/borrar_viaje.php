<?php
include("auth_check.php");
include("../config.php");
include("../clases/Viaje.php");

if(isset($_GET['id'])) {
    $viajeObj = new Viaje($con);
    $viajeObj->eliminar(intval($_GET['id']));
    header("Location: ver_viajes.php?msg=deleted");
} else {
    header("Location: ver_viajes.php");
}
exit();
?>
