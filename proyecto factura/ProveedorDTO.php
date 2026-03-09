<?php

class ProveedorDTO {
    private $nitProveedor;
    private $nombre;
    private $direccion;
    private $telefono;
    private $email;

    // Constructor
    public function __construct($tupla) {
        $this->nitProveedor = $tupla['NIT_PROVEEDOR'];
        $this->nombre = $tupla['NOMBRE'];
        $this->direccion = $tupla['DIRECCION'];
        $this->telefono = $tupla['TELEFONO'];
        $this->email = $tupla['EMAIL'];
    }

    // Métodos getter y setter
    public function getNitProveedor() {
        return $this->nitProveedor;
    }

    public function setNitProveedor($nitProveedor) {
        $this->nitProveedor = $nitProveedor;
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

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
}
?>
