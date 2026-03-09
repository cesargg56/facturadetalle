<?php
require_once 'RepositorioProveedor.php';

$proveedores = RepositorioProveedor::obtenerProveedores();
?>ve
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Proveedores</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .proveedor-mensaje {
            background-color: #fff;
            margin: 10px 0;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }
        .proveedor-mensaje:hover {
            background-color: #e9e9e9;
        }
        .proveedor-mensaje a {
            text-decoration: none;
            color: #333;
            font-size: 16px;
        }
    </style>
</head>
<body>

<h1>Listado de Proveedores</h1>

<?php foreach ($proveedores as $proveedor): ?>
    <div class="proveedor-mensaje">
        <a href="ver_proveedor.php?nitProveedor=<?php echo $proveedor->getNitProveedor(); ?>">
            Proveedor: <?php echo $proveedor->getNombre(); ?> - NIT: <?php echo $proveedor->getNitProveedor(); ?> - Teléfono: <?php echo $proveedor->getTelefono(); ?>
        </a>
    </div>
<?php endforeach; ?>

</body>
</html>
