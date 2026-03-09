<?php
require_once 'Conexion.inc.php';
require_once 'FacturaDTO.php';

class RepositorioFacturas {

    // Método para obtener todas las facturas
    public static function obtenerFacturas() {
        $facturas = [];
        try {
            Conexion::abrir_conexion();
            $conexion = Conexion::obtener_conexion();
            if (isset($conexion)) {
                $sql = "SELECT * FROM FACTURA";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $tupla) {
                        $facturas[] = new FacturaDTO($tupla);
                    }
                }
            }
            Conexion::cerrar_conexion();
        } catch (PDOException $ex) {
            error_log("Error al obtener facturas: " . $ex->getMessage());
            print "<br/>Error al obtener facturas<br/>";
        }
        return $facturas;
    }

    // Método para agregar una nueva factura
    public static function agregarFactura($idEmpleado, $idCliente, $productos) {
        try {
            Conexion::abrir_conexion();
            $conexion = Conexion::obtener_conexion();
            if (isset($conexion)) {
                // Insertar la factura principal
                $sql = "INSERT INTO FACTURA (ID_CLIENTE, ID_EMPLEADO, SERIE, CORRELATIVO, FECHA_REGISTRO)
                        VALUES (:idCliente, :idEmpleado, :serie, :correlativo, :fechaRegistro)";
                $sentencia = $conexion->prepare($sql);
                $serie = 'F';  // Por ejemplo, serie fija
                $correlativo = rand(1000, 9999);  // Correlativo aleatorio
                $fechaRegistro = date('Y-m-d H:i:s');
                $sentencia->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
                $sentencia->bindParam(':idEmpleado', $idEmpleado, PDO::PARAM_INT);
                $sentencia->bindParam(':serie', $serie, PDO::PARAM_STR);
                $sentencia->bindParam(':correlativo', $correlativo, PDO::PARAM_INT);
                $sentencia->bindParam(':fechaRegistro', $fechaRegistro, PDO::PARAM_STR);
                $sentencia->execute();

                // Obtener el ID de la factura recién insertada
                $idFactura = $conexion->lastInsertId();

                // Insertar los detalles de la factura
                foreach ($productos as $producto) {
                    $sqlDetalle = "INSERT INTO DETALLE_FACTURA (ID_FACTURA, ID_PRODUCTO, CANTIDAD, PRECIO_UNITARIO)
                                   VALUES (:idFactura, :idProducto, :cantidad, :precioUnitario)";
                    $sentenciaDetalle = $conexion->prepare($sqlDetalle);
                    $sentenciaDetalle->bindParam(':idFactura', $idFactura, PDO::PARAM_INT);
                    $sentenciaDetalle->bindParam(':idProducto', $producto['idProducto'], PDO::PARAM_INT);
                    $sentenciaDetalle->bindParam(':cantidad', $producto['cantidad'], PDO::PARAM_INT);
                    $sentenciaDetalle->bindParam(':precioUnitario', $producto['precioUnitario'], PDO::PARAM_STR);
                    $sentenciaDetalle->execute();
                }
            }
            Conexion::cerrar_conexion();
        } catch (PDOException $ex) {
            error_log("Error al agregar factura: " . $ex->getMessage());
            print "<br/>Error al agregar factura<br/>";
            Conexion::cerrar_conexion();
        }
    }
}
?>
