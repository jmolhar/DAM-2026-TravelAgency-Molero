<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";
$db_name = "xabi_travels";

try {
    $dsn = "mysql:host=$host;dbname=$db_name;charset=utf8";
    $con = new PDO($dsn, $user, $pass);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>