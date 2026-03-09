<?php
require_once 'Repositorioproducto.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio_unitario = $_POST['precio_unitario'];
    $unidad_medida = $_POST['unidad_medida'];
    $descuento = $_POST['descuento'];

    // Agregar producto
    RepositorioProducto::agregarProducto($nombre, $descripcion, $precio_unitario, $unidad_medida, $descuento);
}

$productos = Repositorioproducto::obtenerProductos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background-color: #f9f9f9;
            margin: 10px 0;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-align: center;
        }
        button:hover {
            background-color: #45a049;
        }
        .btn-regresar {
            background-color: #007BFF;
        }
        .btn-regresar:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Productos</h1>
    <h2>Lista de Productos</h2>
    <ul>
        <?php foreach ($productos as $producto): ?>
            <li>
                <span><?php echo $producto->getNombre(); ?> - <?php echo $producto->getDescripcion(); ?></span>
                <span><?php echo "$" . number_format($producto->getPrecioUnitario(), 2); ?></span>
            </li>
        <?php endforeach; ?>
    </ul>
    
    <!-- Botón para regresar a la página de agregar producto -->
    <a href="producto.php">
        <button class="btn-regresar">Agregar Nuevo Producto</button>
    </a>
</div>

</body>
</html>
