<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 50px;
            text-align: center;
        }
        .menu-rueda {
            width: 300px;
            height: 300px;
            background-color: #e0e0e0;
            border-radius: 50%;
            margin: 0 auto;
            display: grid;
            place-items: center;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }
        .menu-rueda a {
            display: block;
            padding: 20px;
            text-decoration: none;
            color: #333;
            font-size: 18px;
            margin: 10px;
            background-color: #fff;
            border-radius: 50%;
            text-align: center;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
        }
        .menu-rueda a:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

    <div class="menu-rueda">
        <a href="producto.php">Productos</a>
        <a href="agregar_cliente.php">Clientes</a>
        <a href="agregar_proveedor.php">Proveedores</a>
        <a href="agregar_factura.php">Facturas</a>
    </div>

</body>
</html>
