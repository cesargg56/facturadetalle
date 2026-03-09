<?php

class ClienteDTO {
    private $nitCliente;
    private $nombre;
    private $direccion;
    private $telefono;

    // Constructor
    public function __construct($tupla) {
        $this->nitCliente = $tupla['NIT_CLIENTE'];
        $this->nombre = $tupla['NOMBRE'];
        $this->direccion = $tupla['DIRECCION'];
        $this->telefono = $tupla['TELEFONO'];
    }

    // Métodos getter y setter
    public function getNitCliente() {
        return $this->nitCliente;
    }

    public function setNitCliente($nitCliente) {
        $this->nitCliente = $nitCliente;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }
}
?>
