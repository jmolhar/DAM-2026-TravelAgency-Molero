<?php
class Viaje {
    private $con;

    public function __construct($conexion) {
        $this->con = $conexion;
    }

    public function crear($titulo, $descripcion, $fecha_inicio, $fecha_fin, $precio, $destacado, $tipo_viaje, $plazas, $imagen, $continente = null, $destino = null, $itinerario = null) {
        $sql = "INSERT INTO viajes (titulo, descripcion, fecha_inicio, fecha_fin, precio, destacado, tipo_viaje, plazas, imagen, continente, destino, itinerario) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([$titulo, $descripcion, $fecha_inicio, $fecha_fin, $precio, $destacado, $tipo_viaje, $plazas, $imagen, $continente, $destino, $itinerario]);
    }

    public function obtenerTodos() {
        $stmt = $this->con->prepare("SELECT * FROM viajes ORDER BY id_viaje DESC");
        $stmt->execute();
        return $stmt;
    }
    
    public function obtenerDestacados() {
        $stmt = $this->con->prepare("SELECT * FROM viajes WHERE destacado = 1 ORDER BY id_viaje DESC");
        $stmt->execute();
        return $stmt;
    }

    public function obtenerPorId($id) {
        $stmt = $this->con->prepare("SELECT * FROM viajes WHERE id_viaje = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function actualizar($id, $titulo, $descripcion, $fecha_inicio, $fecha_fin, $precio, $destacado, $tipo_viaje, $plazas, $imagen, $continente = null, $destino = null, $itinerario = null) {
        $sql = "UPDATE viajes SET titulo = ?, descripcion = ?, fecha_inicio = ?, fecha_fin = ?, precio = ?, destacado = ?, tipo_viaje = ?, plazas = ?, imagen = ?, continente = ?, destino = ?, itinerario = ? WHERE id_viaje = ?";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([$titulo, $descripcion, $fecha_inicio, $fecha_fin, $precio, $destacado, $tipo_viaje, $plazas, $imagen, $continente, $destino, $itinerario, $id]);
    }

    public function eliminar($id) {
        $stmt = $this->con->prepare("DELETE FROM viajes WHERE id_viaje = ?");
        return $stmt->execute([$id]);
    }
    
    public function obtenerFiltrados($tipo, $continente, $f_inicio, $f_fin) {
        $sql = "SELECT * FROM viajes WHERE 1=1";
        $params = [];

        if (!empty($tipo)) {
            $sql .= " AND tipo_viaje = ?";
            $params[] = $tipo;
        }
        if (!empty($continente)) {
            $sql .= " AND continente = ?";
            $params[] = $continente;
        }
        if (!empty($f_inicio)) {
            $sql .= " AND fecha_inicio >= ?";
            $params[] = $f_inicio;
        }
        if (!empty($f_fin)) {
            $sql .= " AND fecha_fin <= ?";
            $params[] = $f_fin;
        }
        $sql .= " ORDER BY fecha_inicio ASC";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
?>
