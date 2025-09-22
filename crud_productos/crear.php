<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recogemos y limpiamos los datos básicos
    $producto    = trim($_POST['producto'] ?? '');
    $idMarca     = (int)($_POST['idMarca'] ?? 0);
    $descripcion = trim($_POST['Descripcion'] ?? '');
    $precioCosto = str_replace(',', '.', $_POST['precio_costo'] ?? '0');
    $precioVenta = str_replace(',', '.', $_POST['precio_venta'] ?? '0');
    $existencia  = (int)($_POST['existencia'] ?? 0);

    if ($producto && $idMarca > 0 && is_numeric($precioCosto) && is_numeric($precioVenta) && $existencia >= 0) {
        $sql = "INSERT INTO Productos (producto,idMarca,Descripcion,precio_costo,precio_venta,existencia)
                VALUES (?,?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$producto, $idMarca, $descripcion, $precioCosto, $precioVenta, $existencia]);
        header("Location: index.php");
        exit;
    } else {
        $error = "Por favor completa todos los campos correctamente.";
    }
}

// Para el combo de marcas
$marcas = $pdo->query("SELECT idMarca, marca FROM Marcas ORDER BY marca")
              ->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Crear Producto</title>
<link rel="stylesheet" href="assets/style.css">
<link rel="stylesheet" href="assets/crear.css">
</head>
<body>

<header><h1>Nuevo Producto</h1></header>
<div class="container">

<?php if (!empty($error)): ?>
  <p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" action="crear.php">
  <label for="producto">Producto:</label>
  <input id="producto" type="text" name="producto" required>

  <label for="idMarca">Marca:</label>
  <select id="idMarca" name="idMarca" required>
    <option value="">-- Selecciona --</option>
    <?php foreach ($marcas as $m): ?>
      <option value="<?= $m['idMarca'] ?>"><?= htmlspecialchars($m['marca']) ?></option>
    <?php endforeach; ?>
  </select>

  <label for="Descripcion">Descripción:</label>
  <input id="Descripcion" type="text" name="Descripcion">

  <label for="precio_costo">Precio Costo:</label>
  <input id="precio_costo" type="number" step="0.01" name="precio_costo" required>

  <label for="precio_venta">Precio Venta:</label>
  <input id="precio_venta" type="number" step="0.01" name="precio_venta" required>

  <label for="existencia">Existencia:</label>
  <input id="existencia" type="number" name="existencia" required min="0" step="1">

  <!-- ✅ Botón visible y estilizado -->
  <button type="submit" class="btn btn-success">Crear producto</button>

  <!-- Botón opcional para volver al listado -->
  <a href="index.php" class="btn">Volver</a>
</form>

</div>
</body>
</html>
