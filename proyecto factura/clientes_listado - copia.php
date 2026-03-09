<?php
require_once 'RepositorioCliente.php';

$clientes = RepositorioCliente::obtenerClientes();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Clientes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .cliente-mensaje {
            background-color: #fff;
            margin: 10px 0;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }
        .cliente-mensaje:hover {
            background-color: #e9e9e9;
        }
        .cliente-mensaje a {
            text-decoration: none;
            color: #333;
            font-size: 16px;
        }
        button {
            background-color: #007BFF;
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
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<h1>Listado de Clientes</h1>

<?php foreach ($clientes as $cliente): ?>
    <div class="cliente-mensaje">
        <a href="ver_cliente.php?nitCliente=<?php echo $cliente->getNitCliente(); ?>">
            Cliente: <?php echo $cliente->getNombre(); ?> - NIT: <?php echo $cliente->getNitCliente(); ?> - Teléfono: <?php echo $cliente->getTelefono(); ?>
        </a>
    </div>
<?php endforeach; ?>

<!-- Botón para regresar a la página de agregar cliente -->
<a href="agregar_cliente.php">
    <button>Regresar a Agregar Cliente</button>
</a>
</body>
</html>
