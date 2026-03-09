<?php
require_once 'RepositorioProveedor.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nit = $_POST['nit'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    // Agregar el proveedor
    RepositorioProveedor::agregarProveedor($nit, $nombre, $direccion, $telefono, $email);
    header("Location: proveedor_listado.php"); // Redirigir al listado de proveedores
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Proveedor</title>
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
        input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
            width: 100%;
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
        }
        button:hover {
            background-color: #45a049;
        }
        .btn-lista {
            background-color: #007BFF;
        }
        .btn-lista:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Agregar Proveedor</h1>
    <form method="POST">
        <label for="nit">NIT del Proveedor</label>
        <input type="text" name="nit" required>

        <label for="nombre">Nombre del Proveedor</label>
        <input type="text" name="nombre" required>

        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" required>

        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" required>

        <label for="email">Email</label>
        <input type="email" name="email" required>

        <button type="submit">Agregar Proveedor</button>
    </form>
    <!-- Botón para ir a la lista de proveedores -->
    <a href="proveedor_listado.php"><button class="btn-lista">Ir a la Lista de Proveedores</button></a>
    <a href="Menu.php"><button class="btn-lista"> Menu Principal</button></a>
</body>
</html>
