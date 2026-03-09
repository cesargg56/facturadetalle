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
    <title>Productos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        label {
            font-size: 1.1em;
            color: #333;
        }
        input[type="text"], input[type="number"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
            width: 100%;
        }
        input[type="number"] {
            -moz-appearance: textfield;
        }
        button[type="submit"], .btn-lista {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button[type="submit"]:hover, .btn-lista:hover {
            background-color: #45a049;
        }
        .btn-lista {
            background-color: #007BFF;
        }
        .btn-lista:hover {
            background-color: #0056b3;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
        }
        .form-container input, .form-container button {
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Agregar Nuevo Producto</h1>
    <!-- Formulario para agregar producto -->
    <div class="form-container">
        <form action="producto.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br><br>

            <label for="descripcion">Descripción:</label>
            <input type="text" id="descripcion" name="descripcion" required><br><br>

            <label for="precio_unitario">Precio Unitario:</label>
            <input type="number" id="precio_unitario" name="precio_unitario" required><br><br>

            <label for="unidad_medida">Unidad de Medida:</label>
            <input type="text" id="unidad_medida" name="unidad_medida" required><br><br>

            <label for="descuento">Descuento:</label>
            <input type="number" id="descuento" name="descuento" required><br><br>

            <button type="submit">Agregar Producto</button>
        </form>
        <!-- Botón para ir a la lista de productos -->
        <a href="ListaP.php"><button class="btn-lista">Ir a Lista de Productos</button></a>
        <a href="Menu.php"><button class="btn-lista">Menu principal</button></a>
    </div>
</div>

</body>
</html>
