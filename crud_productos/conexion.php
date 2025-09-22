<?php
$host = "localhost";
$db = "bd_parcial_2";
$user = "root";
$passwd = "cñs*-1$!nf0";

try {
    $pdo = new  PDO("mysql:host=$host;dbname=$db;charset=utf8mb4",$user, $passwd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessege());
}
?>