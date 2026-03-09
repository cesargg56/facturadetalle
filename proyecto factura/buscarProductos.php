<?php
require_once 'conexion.inc.php';
require_once 'RepositorioProducto.php';

header('Content-Type: application/json');

$termino = isset($_GET['term']) ? $_GET['term'] : '';

try {
    $productos = RepositorioProducto::buscarProductos($termino);

    // Formatear los resultados para el autocompletado
    $resultados = array_map(function($producto) {
        return [
            'id' => $producto->getIdProducto(),
            'nombre' => $producto->getNombre(),
            'precio' => $producto->getPrecioUnitario(),
            'unidad' => $producto->getUnidadMedida()
        ];
    }, $productos);

    echo json_encode($resultados);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
