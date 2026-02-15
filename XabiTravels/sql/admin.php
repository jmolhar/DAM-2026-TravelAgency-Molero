<?php
$host = '127.0.0.1';
$dbname = 'xabi_travels';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $email = 'admin@xabitravels.com';
    $plainPassword = 'admin123';
    $hash = password_hash($plainPassword, PASSWORD_BCRYPT, ['cost' => 10]);

    $stmt = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    
    if ($stmt->fetch()) {
        $stmt = $pdo->prepare("UPDATE usuarios SET password = ?, es_admin = 1 WHERE email = ?");
        $stmt->execute([$hash, $email]);
        echo "Usuario admin actualizado correctamente.\n";
    } else {
        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, apellidos, email, password, es_admin) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute(['Admin', 'User', $email, $hash, 1]);
        echo "Usuario admin creado correctamente.\n";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
