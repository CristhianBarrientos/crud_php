<?php
require 'conexion.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM Productos WHERE id_producto=?");
$stmt->execute([$id]);
header("Location: index.php");
exit;
?>
