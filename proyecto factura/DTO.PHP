<?php
require_once 'FACTURA.php';
require_once 'FacturaDTO.php';
require_once 'conexion.inc.php';

class RepositorioFacturas {

    public static function obtenerFacturas(){
        $facturas = array();

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
                        $facturas[] = new Factura($tupla);
                    }
                }
            }
            Conexion::cerrar_conexion();

        } catch(PDOException $ex) {
            print "Error " . $ex->getMessage();
            Conexion::cerrar_conexion();
        }

        return $facturas;
    }

    public static function obtenerFactura($idFactura){
        $factura = null;

        try {
            Conexion::abrir_conexion();
            $conexion = Conexion::obtener_conexion();

            if (isset($conexion)) {
                $sql = "SELECT * FROM FACTURA WHERE ID_FACTURA = :idFactura";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute([':idFactura' => $idFactura]);
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    $tupla = $resultado[0];
                    $factura = new Factura($tupla);
                }
            }
            Conexion::cerrar_conexion();
        } catch(PDOException $ex) {
            error_log("error log______________" . $ex->getMessage());
            print "<br/>Error al obtener facturas <br/>";
        }

        return $factura;
    }

    public static function obtenerFacturaPorCodigo($codigoFactura){
        $factura = array(); // Cambiado a array para evitar problemas con el foreach
    
        try {
            Conexion::abrir_conexion();
            $conexion = Conexion::obtener_conexion();
    
            if (isset($conexion)) {
                // Modifica esta consulta según lo que consideres "código de factura"
                $sql = "SELECT F.ID_FACTURA, F.ID_CLIENTE, F.SERIE, F.CORRELATIVO, F.FECHA_REGISTRO, DF.CANTIDAD CANTIDAD_PRODUCTOS, P.NOMBRE PRODUCTO, P.DESCRIPCION DESCRIPCION_PRODUCTO, ".
                    "P.PRECIO_UNITARIO, P.UNIDAD_MEDIDA, C.NIT_CLIENTE NIT, C.NOMBRE NOMBRE_CLIENTE, C.DIRECCION, C.TELEFONO, ".
                    "CONCAT(E.NOMBRE, ' ', E.APELLIDO) CAJERO ".
                    "FROM FACTURA F ".
                    "LEFT JOIN DETALLE_FACTURA DF ON DF.ID_FACTURA = F.ID_FACTURA ".
                    "JOIN PRODUCTO P ON P.ID_PRODUCTO = DF.ID_PRODUCTO ".
                    "JOIN CLIENTE C ON C.ID_CLIENTE = F.ID_CLIENTE ".
                    "JOIN EMPLEADO E ON E.ID_EMPLEADO = F.ID_EMPLEADO ".
                    "WHERE F.ID_FACTURA = :codigoFactura OR F.CORRELATIVO = :codigoFactura";
    
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute([':codigoFactura' => $codigoFactura]);
                $resultado = $sentencia->fetchAll();
    
                if (count($resultado)) {
                    $factura = array_map(function($tupla) {
                        return new FacturaDTO($tupla);
                    }, $resultado);
                }
            }
            Conexion::cerrar_conexion();
        } catch(PDOException $ex) {
            error_log("Error al obtener factura por código: " . $ex->getMessage());
            print "<br/>Error al obtener factura <br/>";
        }
    
        return $factura;

    }
    
    }