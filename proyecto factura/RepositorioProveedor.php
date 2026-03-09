<?php
require_once 'Conexion.inc.php';
require_once 'ProveedorDTO.php';

class RepositorioProveedor {
    // Método para obtener todos los proveedores
    public static function obtenerProveedores() {
        $proveedores = [];
        try {
            Conexion::abrir_conexion();
            $conexion = Conexion::obtener_conexion();
            if (isset($conexion)) {
                $sql = "SELECT * FROM PROVEEDORES";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $tupla) {
                        $proveedores[] = new ProveedorDTO($tupla);
                    }
                }
            }
            Conexion::cerrar_conexion();
        } catch (PDOException $ex) {
            error_log("Error al obtener proveedores: " . $ex->getMessage());
            print "<br/>Error al obtener proveedores<br/>";
        }
        return $proveedores;
    }

    // Método para agregar un nuevo proveedor
    public static function agregarProveedor($nit, $nombre, $direccion, $telefono, $email) {
        try {
            Conexion::abrir_conexion();
            $conexion = Conexion::obtener_conexion();
            if (isset($conexion)) {
                $sql = "INSERT INTO PROVEEDORES (NIT_PROVEEDOR, NOMBRE, DIRECCION, TELEFONO, EMAIL)
                        VALUES (:nit, :nombre, :direccion, :telefono, :email)";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':nit', $nit, PDO::PARAM_STR);
                $sentencia->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $sentencia->bindParam(':direccion', $direccion, PDO::PARAM_STR);
                $sentencia->bindParam(':telefono', $telefono, PDO::PARAM_STR);
                $sentencia->bindParam(':email', $email, PDO::PARAM_STR);
                $sentencia->execute();
            }
            Conexion::cerrar_conexion();
        } catch (PDOException $ex) {
            error_log("Error al agregar proveedor: " . $ex->getMessage());
            print "<br/>Error al agregar proveedor<br/>";
            Conexion::cerrar_conexion();
        }
    }
}
?>
