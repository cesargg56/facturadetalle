<?php
require_once 'RepositorioProducto.php';

$productos = RepositorioProducto::obtenerProductos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Productos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .producto-mensaje {
            background-color: #fff;
            margin: 10px 0;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }
        .producto-mensaje:hover {
            background-color: #e9e9e9;
        }
        .producto-mensaje a {
            text-decoration: none;
            color: #333;
            font-size: 16px;
        }
    </style>
</head>
<body>

<h1>Listado de Productos</h1>

<?php foreach ($productos as $producto): ?>
    <div class="producto-mensaje">
        <a href="ver_producto.php?idProducto=<?php echo $producto->getIdProducto(); ?>">
            Producto: <?php echo $producto->getNombre(); ?> - Precio: <?php echo $producto->getPrecioUnitario(); ?> - Descripción: <?php echo $producto->getDescripcion(); ?>
        </a>
    </div>
<?php endforeach; ?>

</body>
</html>
