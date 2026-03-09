<?php
require_once 'Conexion.inc.php';
require_once 'ClienteDTO.php';

class RepositorioCliente {
    // Método para obtener todos los clientes
    public static function obtenerClientes() {
        $clientes = [];
        try {
            Conexion::abrir_conexion();
            $conexion = Conexion::obtener_conexion();
            if (isset($conexion)) {
                $sql = "SELECT * FROM CLIENTE";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $tupla) {
                        $clientes[] = new ClienteDTO($tupla);
                    }
                }
            }
            Conexion::cerrar_conexion();
        } catch (PDOException $ex) {
            error_log("Error al obtener clientes: " . $ex->getMessage());
            print "<br/>Error al obtener clientes<br/>";
        }
        return $clientes;
    }

    // Método para agregar un nuevo cliente
    public static function agregarCliente($nit, $nombre, $direccion, $telefono) {
        try {
            Conexion::abrir_conexion();
            $conexion = Conexion::obtener_conexion();
            if (isset($conexion)) {
                $sql = "INSERT INTO CLIENTE (NIT_CLIENTE, NOMBRE, DIRECCION, TELEFONO)
                        VALUES (:nit, :nombre, :direccion, :telefono)";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':nit', $nit, PDO::PARAM_STR);
                $sentencia->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $sentencia->bindParam(':direccion', $direccion, PDO::PARAM_STR);
                $sentencia->bindParam(':telefono', $telefono, PDO::PARAM_STR);
                $sentencia->execute();
            }
            Conexion::cerrar_conexion();
        } catch (PDOException $ex) {
            error_log("Error al agregar cliente: " . $ex->getMessage());
            print "<br/>Error al agregar cliente<br/>";
            Conexion::cerrar_conexion();
        }
    }
}
?>
