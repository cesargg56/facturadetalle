<?php
class FacturaDTO {
    private $idFactura;
    private $idCliente;
    private $idEmpleado;
    private $serie;
    private $correlativo;
    private $fechaRegistro;

    public function __construct($tupla) {
        $this->idFactura = $tupla['ID_FACTURA'];
        $this->idCliente = $tupla['ID_CLIENTE'];
        $this->idEmpleado = $tupla['ID_EMPLEADO'];
        $this->serie = $tupla['SERIE'];
        $this->correlativo = $tupla['CORRELATIVO'];
        $this->fechaRegistro = $tupla['FECHA_REGISTRO'];
    }

    public function getIdFactura() {
        return $this->idFactura;
    }

    public function getCliente() {
        return $this->idCliente; // Puedes hacer la búsqueda del nombre del cliente si lo deseas
    }

    public function getEmpleado() {
        return $this->idEmpleado; // Similar a cliente, puedes obtener el nombre del empleado si lo deseas
    }

    public function getSerie() {
        return $this->serie;
    }

    public function getCorrelativo() {
        return $this->correlativo;
    }

    public function getFechaRegistro() {
        return $this->fechaRegistro;
    }
}
?>
