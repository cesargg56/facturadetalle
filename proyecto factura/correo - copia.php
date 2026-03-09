<?php
require_once 'conexion.inc.php';
require_once 'RepositorioFactura.php';

$facturas = RepositorioFacturas::obtenerFacturasDTO();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Facturas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .factura-message {
            background-color: #fff;
            margin: 10px 0;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }
        .factura-message:hover {
            background-color: #e9e9e9;
        }
        .factura-message a {
            text-decoration: none;
            color: #333;
            font-size: 16px;
        }
    </style>
</head>
<body>

    <h1>Listado de Facturas</h1>
    
    <?php foreach ($facturas as $factura): ?>
        <div class="factura-message">
            <a href="correo.php?idFactura=<?php echo $factura->getIdFactura(); ?>">
                Factura No. <?php echo $factura->getCorrelativo(); ?> - Cliente: <?php echo $factura->getNombreCliente(); ?> - Fecha: <?php echo $factura->getFechaRegistro(); ?>
            </a>
        </div>
    <?php endforeach; ?>

</body>
</html>
