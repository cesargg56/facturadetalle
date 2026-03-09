<?php
require_once 'RepositorioProducto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precioUnitario = $_POST['precio_unitario'];
    $unidadMedida = $_POST['unidad_medida'];
    $descuento = $_POST['descuento'];

    // Agregar el producto
    RepositorioProducto::agregarProducto($nombre, $descripcion, $precioUnitario, $unidadMedida, $descuento);
    header("Location: productos_listado.php"); // Redirigir al listado de productos
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
</head>
<body>
    <h1>Agregar Producto</h1>
    <form method="POST">
        <label for="nombre">Nombre del Producto</label><br>
        <input type="text" name="nombre" required><br><br>

        <label for="descripcion">Descripción</label><br>
        <input type="text" name="descripcion" required><br><br>

        <label for="precio_unitario">Precio Unitario</label><br>
        <input type="number" name="precio_unitario" step="0.01" required><br><br>

        <label for="unidad_medida">Unidad de Medida</label><br>
        <input type="text" name="unidad_medida" required><br><br>

        <label for="descuento">Descuento</label><br>
        <input type="number" name="descuento" required><br><br>

        <button type="submit">Agregar Producto</button>
    </form>
</body>
</html>
