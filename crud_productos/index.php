<?php
require 'conexion.php';
$sql = "SELECT p.id_producto, p.producto, p.Descripcion,
               p.precio_costo, p.precio_venta, p.existencia,
               m.marca
        FROM Productos p
        JOIN Marcas m ON p.idMarca = m.idMarca";
$stmt = $pdo->query($sql);
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Listado de Productos</title>
<link rel="stylesheet" href="assets/style.css">
<link rel="stylesheet" href="assets/index.css">
</head>
<body>

<header><h1>Listado de Productos</h1></header>
<div class="container">
   <a class="btn btn-add" href="crear.php">Agregar Producto</a>
   <table>...</table>
</div>

<table>
  <tr>
    <th>ID</th><th>Producto</th><th>Marca</th><th>Descripción</th>
    <th>Precio Costo</th><th>Precio Venta</th><th>Existencia</th><th>Acciones</th>
  </tr>
<?php foreach($productos as $p): ?>
  <tr>
    <td><?= $p['id_producto'] ?></td>
    <td><?= htmlspecialchars($p['producto']) ?></td>
    <td><?= htmlspecialchars($p['marca']) ?></td>
    <td><?= htmlspecialchars($p['Descripcion']) ?></td>
    <td><?= $p['precio_costo'] ?></td>
    <td><?= $p['precio_venta'] ?></td>
    <td><?= $p['existencia'] ?></td>
    <td>
      <a class="btn" href="editar.php?id=<?= $p['id_producto'] ?>">Editar</a>
      <a class="btn" href="eliminar.php?id=<?= $p['id_producto'] ?>"
         onclick="return confirm('¿Seguro de eliminar?');">Eliminar</a>
    </td>
  </tr>
<?php endforeach; ?>
</table>

</body>
</html>
