<?php
class Usuario {
    private $con;

    public function __construct($conexion) {
        $this->con = $conexion;
    }

    public function registrar($nombre, $apellidos, $email, $password) {
        try {
            if($this->emailExiste($email)) {
                return "email_duplicado";
            }
            $sql = "INSERT INTO usuarios (nombre, apellidos, email, password, es_admin) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->con->prepare($sql);
            $stmt->execute([$nombre, $apellidos, $email, password_hash($password, PASSWORD_DEFAULT), 0]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function login($email, $password) {
        $stmt = $this->con->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch();
        if ($usuario && password_verify($password, $usuario['password'])) {
            return $usuario;
        }
        return false;
    }

    public function emailExiste($email) {
        $stmt = $this->con->prepare("SELECT id_usuario FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }
}
?>
