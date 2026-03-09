<?php
require_once 'Conexion.inc.php';
require_once 'RepositorioProducto.php';

header('Content-Type: application/json');

$term = isset($_GET['term']) ? $_GET['term'] : '';

try {
    $productos = RepositorioProducto::buscarProductos($term);
    
    // Formatear los resultados para el autocompletado
    $resultados = array_map(function($producto) {
        return [
            'id' => $producto['ID_PRODUCTO'],
            'nombre' => $producto['NOMBRE'],
            'precio' => $producto['PRECIO_UNITARIO'],
            'unidad' => $producto['UNIDAD_MEDIDA']
        ];
    }, $productos);
    
    echo json_encode($resultados);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>